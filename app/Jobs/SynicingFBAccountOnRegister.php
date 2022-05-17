<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\SocialAccount\FacebookAccountService;
use App\Services\FacebookAds\FacebookAdsAccountService;
use App\Services\FacebookAds\FacebookAdsInsightsService;
use App\Services\UserSelectedAccount\UserSelectedAccountService;
use App\FacebookAdsDataMonthly;
use App\FacebookAdsCampaign;
use App\Services\CurlService;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Facebook\Facebook;
use App\FacebookPage;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class SynicingFBAccountOnRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $accessToken = null;
    private $userID = null;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($accessToken, $userID)
    {
        $this->accessToken = $accessToken;
        $this->userID = $userID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        FacebookAdsAccountService $fbAdsAccountService,
        FacebookAdsInsightsService $fbAdsInsightsService,
        FacebookAccountService $fbAccountService,
        UserSelectedAccountService $userSelectAccountService,
        FacebookAdsDataMonthly $facebookAdsDataMonthly,
        FacebookAdsCampaign $facebookAdsCampaign,
        CurlService $curlService
    )
    {
        try {
            $accounts = $fbAdsAccountService->getListAdsAccounts($this->accessToken);
            //avoid foreach not working for none accounts
            if (is_object($accounts) || is_array($accounts)) {
                foreach ($accounts as $accountObj) {
                    $account = (object)$accountObj;
                    $account->access_token = $this->accessToken;
                    $fbAdsAccountService->addAdsAccount($account, $this->userID);
                }
            }

            $all_campagin = $facebookAdsCampaign::where('status', '=', 'ACTIVE')->orwhere('status', '=', 'PAUSED')->where('user_id', '=', auth()->id())->get();

            if ($all_campagin) {
                foreach ($all_campagin as $all_campagins) {
                    $campagin_id = $all_campagins->campaign_id;
                    $user_id = $all_campagins->user_id;
                    $social_id = $all_campagins->social_id;

                    for ($month = 1; $month <= 12; $month++) {
                        $date = Carbon::createFromFormat('m', $month);
                        $start = $date->copy()->startOfMonth()->format('Y-m-d');
                        $end = $date->copy()->endOfMonth()->format('Y-m-d');
                        $spend = json_decode($this->getAccountSpendByDate($all_campagins, $start, $end, $this->accessToken, $curlService));

                        if (isset($spend->data) && count($spend->data)) {
                            $data = $spend->data;
                            $spend = $data[0]->spend;
                            $account_currency = $data[0]->account_currency;
                            $impressions = $data[0]->impressions;
                            $reach = $data[0]->reach;
                            $clicks = $data[0]->clicks;
                            $frequency = $data[0]->frequency;
                            $cost_per_inline_link_click = $data[0]->cost_per_inline_link_click;
                            $facebookAdsDataMonthly::updateOrCreate([
                                'date' => $date->copy()->startOfMonth(),
                                'campaign_id' => $campagin_id
                            ], [
                                'date' => $date->copy()->startOfMonth(),
                                'user_id' => $user_id,
                                'social_id' => $social_id,
                                'campaign_id' => $campagin_id,
                                'spend' => $spend,
                                'impressions' => $impressions,
                                'reach' => $reach,
                                'clicks' => $clicks,
                                'frequency' => $frequency,
                                'cost_per_inline_link_click' => $cost_per_inline_link_click,
                                'account_currency' => $account_currency,
                                'roas' => 0
                            ]);
                        } else {
                            $facebookAdsDataMonthly::updateOrCreate([
                                'date' => $date->copy()->startOfMonth(),
                                'campaign_id' => $campagin_id
                            ], [
                                'date' => $date->copy()->startOfMonth(),
                                'campaign_id' => $campagin_id,
                                'user_id' => $user_id,
                                'social_id' => $social_id,
                                'spend' => 0,
                                'impressions' => 0,
                                'reach' => 0,
                                'clicks' => 0,
                                'frequency' => 0,
                                'cost_per_inline_link_click' => 0,
                                'account_currency' => '',
                                'roas' => 0
                            ]);
                        }
                    }
                }
            }

            // $pages = self::getListAdminPage($this->accessToken);

            // foreach ($pages as $pageObj) {
            //     $page = (object)$pageObj;
            //     $this->addFacebookPage($page, $this->userID);
            // }
            return true;
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }

    // private function addFacebookPage($pageObj, $userID)
    // {
    //     $page = FacebookPage::where('page_id', $pageObj->id)->first();
    //     if (!$page) {
    //         $page = new FacebookPage;
    //     }
    //     $page->name = $pageObj->name;
    //     $page->avatar = "";
    //     $page->page_id = $pageObj->id;
    //     $page->access_token = $pageObj->access_token;
    //     $page->user_id = auth()->id();
    //     $page->save();
    //     self::updateFanpageAva($page);
    //     //    toastr()->success('Add fanpage successfully!');
    //     return redirect()->back();
    // }

    public function getAccountSpendByDate($account, $start, $end, $accessToken, $curlService)
    {
        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $account->campaign_id . '/insights/?time_range[since]=' . $start . '&time_range[until]=' . $end . '&fields=account_currency,spend,impressions,buying_type,clicks,reach,frequency,cost_per_inline_link_click&access_token=' . $this->accessToken;
        return $curlService->sendGetRequestApi($url);
    }

    public static function getListAdminPage($accessToken)
    {
        $fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_version'),
        ]);
        try {
            $response = $fb->get('/me/accounts', $accessToken);
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $pages = $response->getGraphEdge()->asArray();
        return $pages;
    }

}
