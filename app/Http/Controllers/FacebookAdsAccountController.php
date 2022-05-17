<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialAccount\FacebookAccountService;
use App\Services\FacebookAds\FacebookAdsAccountService;
use App\Services\FacebookAds\FacebookAdsInsightsService;
use App\Services\UserSelectedAccount\UserSelectedAccountService;
use App\FacebookPage;
use App\FacebookAdsDataMonthly;
use App\FacebookAdsCampaign;
use Carbon\Carbon;
use App\Services\CurlService;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use App\Jobs\SynicingFBAccountOnRegister;

class FacebookAdsAccountController extends Controller
{
    //
    private $fbAdsInsightsService = null;
    private $fbAccountService = null;
    private $fbAdsAccountService = null;
    private $userSelectAccountService = null;
    private $facebookAdsDataMonthly = null;
    private $facebookAdsCampaign = null;
    private $curlService = null;
    public function __construct(
        FacebookAdsAccountService $fbAdsAccountService,
        FacebookAdsInsightsService $fbAdsInsightsService,
        FacebookAccountService $fbAccountService,
        UserSelectedAccountService $userSelectAccountService,
        FacebookAdsDataMonthly $facebookAdsDataMonthly,
        FacebookAdsCampaign $facebookAdsCampaign,
        CurlService $curlService
    ) {
        $this->fbAdsAccountService = $fbAdsAccountService;
        $this->fbAdsInsightsService = $fbAdsInsightsService;
        $this->fbAccountService = $fbAccountService;
        $this->userSelectAccountService = $userSelectAccountService;
        $this->facebookAdsDataMonthly = $facebookAdsDataMonthly;
        $this->facebookAdsCampaign = $facebookAdsCampaign;
        $this->curlService = $curlService;
    }

    public function index()
    {
        $accounts = $this->fbAdsAccountService->listAccounts(['user_id' => auth()->id()]);
        $pages = $this->fbAccountService->list(['user_id' => auth()->id()]);
        $userSelectAccount = $this->userSelectAccountService->firstRow(['user_id' => auth()->id()]);
        $isDisabledSelectBtn = $userSelectAccount && $userSelectAccount->page_id;
        if (is_object($pages) && count($pages)) {
            foreach ($pages as &$page) {
                if ($userSelectAccount && $userSelectAccount->page_id == $page->page_id) {
                    $page['is_selected'] = true;
                } else {
                    $page['is_selected'] = false;
                }
            }
        }
        return view('facebook-ads.list-account')->with([
            'accounts' => $accounts,
            'pages' => $pages,
            'isDisabledSelectBtn' => $isDisabledSelectBtn
        ]);
    }


    public function getAccountSpendByDate($account, $start, $end, $accessToken)
    {
        // $start= "2018-10-05";
        // $end = "2021-11-05";

        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $account->campaign_id . '/insights/?time_range[since]=' . $start . '&time_range[until]=' . $end . '&fields=account_currency,spend,impressions,buying_type,clicks,reach,frequency,cost_per_inline_link_click&access_token=' . $accessToken;

        return $this->curlService->sendGetRequestApi($url);
    }




    public function getAccessToken($accessToken, $userID)
    {

        try {
            $accounts = $this->fbAdsAccountService->getListAdsAccounts($accessToken);
            //avoid foreach not working for none accounts
            if (is_object($accounts) || is_array($accounts)) {
                foreach ($accounts as $accountObj) {
                    $account = (object)$accountObj;
                    $account->access_token = $accessToken;
                    $this->fbAdsAccountService->addAdsAccount($account, $userID);
                }
            }

            $all_campagin = $this->facebookAdsCampaign::where([
                ['status', '=', 'ACTIVE'],
                ['user_id', '=', auth()->id()]
            ])->get();
            if ($all_campagin) {
                foreach ($all_campagin as $all_campagins) {
                    $campagin_id = $all_campagins->campaign_id;
                    $user_id = $all_campagins->user_id;
                    $social_id = $all_campagins->social_id;

                    for ($month = 1; $month <= date('m'); $month++) {
                        $date = Carbon::createFromFormat('m', $month);
                        $start = $date->copy()->startOfMonth()->format('Y-m-d');
                        $end = $date->copy()->endOfMonth()->format('Y-m-d');

                        $spend = json_decode($this->getAccountSpendByDate($all_campagins, $start, $end, $accessToken));

                        if (isset($spend->data) && count($spend->data)) {
                            $data = $spend->data;
                            $spend = $data[0]->spend;
                            $account_currency = $data[0]->account_currency;
                            $impressions = $data[0]->impressions;
                            $reach = $data[0]->reach;
                            $clicks = $data[0]->clicks;
                            $frequency = $data[0]->frequency;
                            $cost_per_inline_link_click = $data[0]->cost_per_inline_link_click;
                            $this->facebookAdsDataMonthly::updateOrCreate([
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
                            $this->facebookAdsDataMonthly::updateOrCreate([
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
            $pages = self::getListAdminPage($accessToken);

            foreach ($pages as $pageObj) {
                $page = (object)$pageObj;
                $this->addFacebookPage($page, $userID);
            }

            return redirect('facebook-ads/accounts');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function getAccessTokenV2($accessToken, $userID)
    {
        SynicingFBAccountOnRegister::dispatch($accessToken, $userID);
        return redirect(url('/dashboard'));

        // try {
        //     $accounts = $this->fbAdsAccountService->getListAdsAccounts($accessToken);
        //     //avoid foreach not working for none accounts
        //     if (is_object($accounts) || is_array($accounts)) {
        //         foreach ($accounts as $accountObj) {
        //             $account = (object)$accountObj;
        //             $account->access_token = $accessToken;
        //             $this->fbAdsAccountService->addAdsAccount($account, $userID);
        //         }
        //     }

        //     $all_campagin = $this->facebookAdsCampaign::where('status', '=', 'ACTIVE')->orwhere('status', '=', 'PAUSED')->where('user_id', '=', auth()->id())->get();

        //     if ($all_campagin) {
        //         foreach ($all_campagin as $all_campagins) {
        //             $campagin_id = $all_campagins->campaign_id;
        //             $user_id = $all_campagins->user_id;
        //             $social_id = $all_campagins->social_id;

        //             for ($month = 1; $month <= 12; $month++) {
        //                 $date = Carbon::createFromFormat('m', $month);
        //                 $start = $date->copy()->startOfMonth()->format('Y-m-d');
        //                 $end = $date->copy()->endOfMonth()->format('Y-m-d');
        //                 $spend = json_decode($this->getAccountSpendByDate($all_campagins, $start, $end, $accessToken));

        //                 if (isset($spend->data) && count($spend->data)) {
        //                     $data = $spend->data;
        //                     $spend = $data[0]->spend;
        //                     $account_currency = $data[0]->account_currency;
        //                     $impressions = $data[0]->impressions;
        //                     $reach = $data[0]->reach;
        //                     $clicks = $data[0]->clicks;
        //                     $frequency = $data[0]->frequency;
        //                     $cost_per_inline_link_click = $data[0]->cost_per_inline_link_click;
        //                     $this->facebookAdsDataMonthly::updateOrCreate([
        //                         'date' => $date->copy()->startOfMonth(),
        //                         'campaign_id' => $campagin_id
        //                     ], [
        //                         'date' => $date->copy()->startOfMonth(),
        //                         'user_id' => $user_id,
        //                         'social_id' => $social_id,
        //                         'campaign_id' => $campagin_id,
        //                         'spend' => $spend,
        //                         'impressions' => $impressions,
        //                         'reach' => $reach,
        //                         'clicks' => $clicks,
        //                         'frequency' => $frequency,
        //                         'cost_per_inline_link_click' => $cost_per_inline_link_click,
        //                         'account_currency' => $account_currency,
        //                         'roas' => 0
        //                     ]);
        //                 } else {
        //                     $this->facebookAdsDataMonthly::updateOrCreate([
        //                         'date' => $date->copy()->startOfMonth(),
        //                         'campaign_id' => $campagin_id
        //                     ], [
        //                         'date' => $date->copy()->startOfMonth(),
        //                         'campaign_id' => $campagin_id,
        //                         'user_id' => $user_id,
        //                         'social_id' => $social_id,
        //                         'spend' => 0,
        //                         'impressions' => 0,
        //                         'reach' => 0,
        //                         'clicks' => 0,
        //                         'frequency' => 0,
        //                         'cost_per_inline_link_click' => 0,
        //                         'account_currency' => '',
        //                         'roas' => 0
        //                     ]);
        //                 }
        //             }
        //         }
        //     }

        //     $pages = self::getListAdminPage($accessToken);

        //     foreach ($pages as $pageObj) {
        //         $page = (object)$pageObj;
        //         $this->addFacebookPage($page, $userID);
        //     }
        //     return redirect(url('/dashboard'));
        // } catch (\Exception $e) {
        //     dd($e);
        //     return false;
        // }
    }

    public static function updateFanpageAva($page)
    {
        $access_token = $page->access_token;
        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $page->page_id . '/picture?redirect=0&access_token=' . $access_token;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Facebook get user information request',
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $resp = curl_exec($curl);
        $resp = json_decode($resp);
        try {
            $page->avatar = $resp->data->url;
            $page->save();
            return $resp->data->url;
        } catch (\Exception $e) {
            Log::info("Update ava error");
            Log::info(json_encode($resp));
        }
    }

    private function addFacebookPage($pageObj, $userID)
    {
        $page = FacebookPage::where('page_id', $pageObj->id)->first();
        if (!$page) {
            $page = new FacebookPage;
        }
        $page->name = $pageObj->name;
        $page->avatar = "";
        $page->page_id = $pageObj->id;
        $page->access_token = $pageObj->access_token;
        $page->user_id = auth()->id();
        $page->save();
        self::updateFanpageAva($page);
        //    toastr()->success('Add fanpage successfully!');
        return redirect()->back();
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






    public function adsaccountdel($accessToken, $userID)
    {
        dd('hi');

        // try {
        //     $accounts = $this->fbAdsAccountService->getListAdsAccounts($accessToken);

        //     //avoid foreach not working for none accounts
        //     if (is_object($accounts) || is_array($accounts)) {
        //         foreach ($accounts as $accountObj) {
        //             $account = (object)$accountObj;
        //             $account->access_token = $accessToken;
        //             $this->fbAdsAccountService->addAdsAccount($account, $userID);
        //         }
        //     }
        //     return redirect()->back();
        // } catch (\Exception $e) {
        //     return redirect()->back();
        // }
    }


    public function getInsights($id)
    {
        try {
            $account = $this->fbAdsAccountService->firstRow(['id' => $id]);
            if (!$account) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Account is not found'
                ]);
            }
            $insights = $this->fbAdsInsightsService->listByYear($account->id);
            return response()->json([
                'status' => 'success',
                'data' => [
                    'insights' => $insights,
                    'spend' => $account->facebook_ads_social_account->spend
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function selectPage(Request $request)
    {
        try {
            $pageId = $request->select_fanpage;
            $page = $this->fbAccountService->firstRow([
                'page_id' => $pageId,
                'user_id' => auth()->id()
            ]);
            if (!$page) {
                return redirect()->back()->with([
                    'danger' => 'Page does not exist'
                ]);
            }
            $userSelectAccount = $this->userSelectAccountService->updateOrCreate([
                'user_id' => auth()->id()
            ], [
                'user_id' => auth()->id(),
                'industry_id' => auth()->user()->industry->id,
                'facebook_ads_account_id' => $page->social_id,
                // 'ad_set_id' => $page->ad_set_id,
                'page_id' => $pageId
            ]);

            return redirect()->back()->with([
                'success' => 'Select page successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
