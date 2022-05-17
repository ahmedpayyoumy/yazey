<?php

namespace App\Services\FacebookAds;

use App\Services\CRUDService;
use App\Services\CurlService;
use App\Services\FacebookAds\FacebookAdsTargetService;
use App\Services\FacebookAds\FacebookAdsInsightsService;
use App\Services\SocialAccount\FacebookAccountService;
use App\Services\ROAS\RoasReportService;
use App\SocialAccount;
use App\FacebookAdsCampaign;
use App\FacebookAdsSet;
use Yajra\DataTables\DataTables;
use App\Jobs\CrawlFacebookAdsJob;
use App\Helpers\DateTime\DateTimeHelper;
use Carbon\Carbon;
use Log;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Storage;

class FacebookAdsSetService extends CRUDService
{
    private $curlService = null;
    private $fbAdsTargetService = null;
    private $fbAdsInsightsService = null;
    private $fb = null;
    private $fbAccountService = null;
    private $roasReportService = null;
    private $facebookAdsSet = null;


    public function __construct(
        CurlService $curlService,
        FacebookAdsTargetService $fbAdsTargetService,
        FacebookAdsInsightsService $fbAdsInsightsService,
        FacebookAccountService $fbAccountService,
        RoasReportService $roasReportService,
        FacebookAdsSet $facebookAdsSet
    ) {
        parent::__construct(FacebookAdsSet::class);
        $this->curlService = $curlService;
        $this->fbAdsTargetService = $fbAdsTargetService;
        $this->fbAccountService = $fbAccountService;
        $this->fbAdsInsightsService = $fbAdsInsightsService;
        $this->roasReportService = $roasReportService;
        $this->facebookAdsSet = $facebookAdsSet;
        $this->fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_version'),
        ]);
    }

    public function getData($request)
    {
        $campaigns = $this->listByConditions(
            ['campaign_id' => $request->id],
            [],
            'start_time',
            'DESC'
        );
        $dt = DataTables::of($campaigns)
            ->editColumn('name', function ($item) {
                return '<a class="text-hover-primary text-dark-75 font-weight-bolder mb-1 font-size-lg">' . $item->name . '</a>';
            })
            ->editColumn('budget', function ($item) {
                return $item->daily_budget ? number_format($item->daily_budget) : number_format($item->lifetime_budget);
            })
            ->editColumn('bid_amount', function ($item) {
                return number_format($item->bid_amount);
            })
            ->editColumn('actions', function ($item) {
                $html = '';
                $html .= '<span class="text__edit warehouse__action"><a href="/facebook-ads/ad-sets/' . $item->id . '/edit' . '" class="">
                            Chỉnh sửa
                        </a></span>';
                $html .= '<span class="text__edit warehouse__action"><a href="/facebook-ads/ad-sets/' . $item->id . '/ads' . '" class="">
                            Chi tiết
                        </a></span>';
                $html .= '<span class="text__delete warehouse__action"><a href="/facebook-ads/ad-sets/' . $item->id . '/delete' . '" class="btn-delete">
                            Xóa
                        </a></span>';
                return $html;
            })
            ->rawColumns(['name', 'actions']);
        return $dt->make(true);
    }

    public function saveAdsSet($adsSet, FacebookAdsCampaign $campaign)
    {

        $user = $this->facebookAdsSet;

        try {
            $result = $user::updateOrCreate([
                'ad_set_id' => $adsSet->id,
                'campaign_id' => $campaign->id,
                'social_id' => $campaign->social_id,
                'user_id' => $campaign->user_id
            ], [
                'ad_set_id' => $adsSet->id,
                'campaign_id' => $campaign->id,
                'social_id' => $campaign->social_id,
                'user_id' => $campaign->user_id,
                'name' => $adsSet->name,
                'daily_budget' => $adsSet->daily_budget ?? 0,
                'lifetime_budget' => $adsSet->lifetime_budget ?? 0,
                'bid_amount' => $adsSet->bid_amount ?? 0,
                'bid_strategy' => $adsSet->bid_strategy ?? null,
                'billing_events' => $adsSet->billing_event ?? null,
                'optimization_goal' => $adsSet->optimization_goal ?? null,
                'status' => $adsSet->status,
                'targeting' => $adsSet->targeting,
                'promoted_object' => $adsSet->promoted_object ?? null,
                'created_time' => $adsSet->created_time,
                'start_time' => $adsSet->start_time,
                'destination_type' => $adsSet->destination_type
            ]);

            return $result;
        } catch (\Exception $e) {

            Log::info($e->getMessage());
            Storage::append('file.txt', $e->getMessage());
        }
    }


    public function getAllAdsSets(FacebookAdsCampaign $campaign, $accessToken, $enablePagination = false)
    {


        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $campaign->campaign_id . '/adsets?fields=id,name,daily_budget,lifetime_budget,bid_amount,bid_strategy,billing_event,optimization_goal,status,targeting,promoted_object,created_time,start_time,destination_type,budget_remaining&access_token=' . $accessToken;

        $result = $this->curlService->sendGetRequestApi($url);

        $result = json_decode($result);

        if ($result && isset($result->data)) {
            $adsSets = $result->data;
            for ($i = 0; $i < count($adsSets); $i++) {
                $d = $adsSets[$i];
                $adsSet = $this->saveAdsSet($d, $campaign);

                // if ($adsSet->promoted_object && isset($adsSet->promoted_object['page_id'])) {
                //     $socialAccount = $adsSet->social_account;
                //     $pageId = $adsSet->promoted_object['page_id'];

                //     if ($socialAccount) {
                //         $page = $this->fbAccountService->getAdminPageByPageId($pageId,$accessToken);

                //         $this->fbAccountService->updateOrCreate([
                //             'user_id' => $socialAccount->user_id,
                //             'page_id' => $page['id'],
                //             'social_id' => $campaign->social_id
                //         ], [
                //             'user_id' => $socialAccount->user_id,
                //             'page_id' => $page['id'],
                //             'social_id' => $campaign->social_id,
                //             'name' => $page['name'],
                //             'avatar' => $page['picture']['url']
                //         ]);
                //         $adsSet->update(['page_id' => $page['id']]);
                //         $spend = json_decode($this->fbAdsInsightsService->getTotalAdsSetSpend($adsSet, $accessToken));

                //         if (isset($spend->data) && count($spend->data)) {
                //             $data = $spend->data;
                //             $spend = $data[0]->spend;
                //             $adsSet->update([
                //                 'spend' => $spend ?? 0
                //             ]);
                //         }



                //     }
                // }
                // $this->roasReportService->updateReportByAdsSet($adsSet);
                // CrawlFacebookAdsJob::dispatch($adsSet, $accessToken)
                //                         ->onQueue('crawl_facebook_ads');
            }
        }
        // if ($enablePagination) {
        //     $paging = $result->paging;
        //     try {
        //         if (isset($paging->cursors->after)) {
        //             $this->travelPagination()
        //         }
        //     } catch (\Exception $e) {
        //         Log::info($e->getMessage());

        //     }
        // }
    }

    public function getAdsSetById($id, $accessToken, FacebookAdsCampaign $campaign)
    {
        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $id . '?fields=id,name,daily_budget,lifetime_budget,bid_amount,bid_strategy,billing_event,optimization_goal,status,targeting,promoted_object,created_time,start_time,destination_type&access_token=' . $accessToken;
        $result = $this->curlService->sendGetRequestApi($url);
        $result = json_decode($result);

        if ($result) {
            $this->saveAdsSet($result, $campaign);
        }
    }


    private function buildAdsSetUpdateParams(FacebookAdsSet $adsSet, $data)
    {
        return [
            'name' => $data['name'],
            'bid_amount' => $data['bid_amount'] ? (int)$data['bid_amount'] : 1,
            'start_time' => isset($data['start_time']) ? DateTimeHelper::formatAdsTime($data['start_time']) : DateTimeHelper::formatAdsTime($adsSet->start_time),
            'end_time' => isset($data['end_time']) ? DateTimeHelper::formatAdsTime($data['end_time']) : ($adsSet->end_time ? DateTimeHelper::formatAdsTime($adsSet->end_time) : 0),
            'status' => $data['status']
        ];
    }

    private function buildAdsSetCreateParams($data)
    {
        $data['daily_budget'] = ($data['budget'] == 'daily_budget') ? $data['budget_amount'] : 0;
        $data['lifetime_budget'] = ($data['budget'] == 'lifetime_budget') ? $data['budget_amount'] : 0;

        return [
            'name' => $data['name'],
            'optimization_goal' => $data['optimization_goal'],
            // 'bid_amount' => $data['bid_amount'] ? (int)$data['bid_amount'] : 1,
            'bid_strategy' => $data['bid_strategy'],
            'billing_event' => isset($data['billing_events']) ? $data['billing_events'] : '',
            'daily_budget' => (int)$data['daily_budget'] ?? ((int)$data['lifetime_budget'] ?? 1),
            'lifetime_budget' => (int)$data['lifetime_budget'] ?? ((int)$data['daily_budget'] ?? 1),
            'start_time' => isset($data['start_time']) ? DateTimeHelper::formatAdsTime($data['start_time']) : '',
            'end_time' => isset($data['end_time']) ? DateTimeHelper::formatAdsTime($data['end_time']) : 0,
            'status' => $data['status'],
            'destination_type' => $data['destination_type']
        ];
    }

    public function updateAdsSet(FacebookAdsSet $adsSet, $data)
    {
        try {
            $account = $adsSet->social_account;
            if ($account) {
                $params = $this->buildAdsSetUpdateParams($adsSet, $data);
                $targeting = $this->fbAdsTargetService->buildTargettingParams($data);
                $params['targeting'] = (object)$targeting;

                $fbAdsSet = $this->fb->post(
                    '/' . $adsSet->ad_set_id,
                    $params,
                    $account->access_token
                );

                return $fbAdsSet->getGraphNode();
            }
            return null;
        } catch (FacebookResponseException $e) {
            return ['error' => $e->getResponseData()];
        } catch (FacebookSDKException $e) {
            return ['error' => $e->getResponseData()];
        }
    }

    public function createAdsSet(FacebookAdsCampaign $campaign, $data)
    {
        try {
            $account = $campaign->social_account;
            if ($account) {
                $params = $this->buildAdsSetCreateParams($data);
                $params['campaign_id'] = $campaign->campaign_id;
                $targeting = $this->fbAdsTargetService->buildTargettingParams($data);
                $params['targeting'] = (object)$targeting;
                $params['promoted_object'] = (object)[
                    'page_id' => $data['page_id']
                ];

                // dd($params);

                $fbAdsSet = $this->fb->post(
                    '/' . $account->social_id . '/adsets',
                    $params,
                    $account->access_token
                );

                return $fbAdsSet->getGraphNode();
            }
            return null;
        } catch (FacebookResponseException $e) {
            return ['error' => $e->getResponseData()];
        } catch (FacebookSDKException $e) {
            return ['error' => $e->getResponseData()];
        }
    }

    public function deleteAdsSet(SocialAccount $account, FacebookAdsSet $adsSet)
    {
        try {
            $response = $this->fb->delete(
                '/' . $adsSet->ad_set_id,
                [],
                $account->access_token
            );
            return $response->getGraphNode();
        } catch (FacebookResponseException $e) {
            return ['error' => $e->getResponseData()];
        } catch (FacebookSDKException $e) {
            return ['error' => $e->getResponseData()];
        }
    }
}
