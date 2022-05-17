<?php
namespace App\Services\FacebookAds;

use App\Services\CRUDService;
use App\Services\CurlService;
use App\Services\FacebookAds\FacebookAdCreativeService;
use App\Services\FacebookAds\FacebookAdsImageService;
use App\FacebookAdsSet;
use App\FacebookAd;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Log;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FacebookAdsService extends CRUDService
{
    private $curlService = null;
    private $fbAdsCreativeService = null;
    private $fbAdsImageService = null;
    private $fb = null;

    public function __construct(
        CurlService $curlService,
        FacebookAdCreativeService $fbAdsCreativeService,
        FacebookAdsImageService $fbAdsImageService
    ) {
        parent::__construct(FacebookAd::class);
        $this->curlService = $curlService;
        $this->fbAdsCreativeService = $fbAdsCreativeService;
        $this->fbAdsImageService = $fbAdsImageService;
        $this->fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_version'),
        ]);
    }

    public function getData($request)
    {
        
        $campaigns = $this->listByConditions(
            ['ad_set_id' => $request->id],
            [],
            'created_time',
            'DESC'
        );
        $dt = DataTables::of($campaigns)
            ->editColumn('name', function ($item) {
                return '<a class="text-hover-primary text-dark-75 font-weight-bolder mb-1 font-size-lg">'.$item->name.'</a>';
            })
            ->editColumn('actions', function ($item) {
                $html = '';
                $html .= '<span class="text__edit warehouse__action"><a href="/facebook-ads/ads/'.$item->id . '" class="">
                            Chi tiết
                        </a></span>';
                // $html .= '<span class="text__delete warehouse__action"><a href="/facebook-ads/ads/'.$item->id.'/delete' . '" class="btn-delete">
                //             Xóa
                //         </a></span>';
                return $html;
            })
            ->rawColumns(['name', 'actions']);
        return $dt->make(true);
    }

    public function saveAds($ad, FacebookAdsSet $adsSet)
    {
        $result = $this->updateOrCreate([
            'ad_id' => $ad->id,
            'ad_set_id' => $adsSet->id,
            'social_id' => $adsSet->social_id,
            'company_id' => $adsSet->company_id
        ], [
            'ad_id' => $ad->id,
            'ad_set_id' => $adsSet->id,
            'social_id' => $adsSet->social_id,
            'company_id' => $adsSet->company_id,
            'name' => $ad->name,
            'status' => $ad->status,
            'created_time' => $ad->created_time
        ]);
        return $result;
    }

    public function getAllAds(FacebookAdsSet $adsSet, $accessToken, $enablePagination = false)
    {
        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $adsSet->ad_set_id . '/ads?fields=id,name,status,created_time,creative{id,name,object_story_spec}&access_token=' . $accessToken;
        $result = $this->curlService->sendGetRequestApi($url);
        $result = json_decode($result);
        dd($result);
        if ($result && isset($result->data)) {
            $ads = $result->data;
            for ($i = 0; $i < count($ads); $i++) {
                $d = $ads[$i];
                $ad = $this->saveAds($d, $adsSet);
                if ($d->creative) {
                    $campaign = $adsSet->ad_campaign;
                    if ($campaign) {
                        $adCreative = $this->fbAdsCreativeService->saveAdCreative($d->creative, $adsSet, $campaign->ad_account_id);
                        if (isset($adCreative->object_story_spec['link_data']['image_hash'])) {
                            $imageHash = $adCreative->object_story_spec['link_data']['image_hash'];
                            $account = $adsSet->social_account;
                            $adsImage = $this->fbAdsImageService->getImageByHash($imageHash, $account);
                            if ($adsImage) {
                                $this->fbAdsImageService->saveAdImage($adsImage[0], $account);
                            }
                        }
                        $isExist = $ad->creatives()->where(['i_facebook_ads_ad_creatives.creative_id' => $adCreative->id])->first();
                        if (!$isExist) {
                            $ad->creatives()->attach($adCreative->id);
                        }
                    }
                }
                // CrawlFacebookAdsJob::dispatch($ad, $accessToken)
                //                         ->onQueue('crawl_facebook_ads');
            }
        }
        if ($enablePagination) {
            // $paging = $result->paging;
            // try {
            //     if (isset($paging->cursors->after)) {
            //         $this->travelPagination()
            //     }
            // } catch (\Exception $e) {
            //     Log::info($e->getMessage());
            //
            // }
        }
    }

    public function getAdsById($id, $accessToken, FacebookAdsSet $adsSet)
    {
        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $id . '?fields=id,name,status,created_time&access_token=' . $accessToken;
       
        $result = $this->curlService->sendGetRequestApi($url);
        $result = json_decode($result);

        if ($result) {
            $this->saveAds($result, $adsSet);
        }
    }

    private function buildAdsUpdateParams(FacebookAd $ads, $data)
    {
        return [
            'name' => $data['name'],
            'status' => $data['status']
        ];
    }

    public function updateAds(FacebookAd $ads, $data)
    {
        try {
            $account = $ads->social_account;
            if ($account) {
                $params = $this->buildAdsUpdateParams($ads, $data);
                $fbAds = $this->fb->post(
                    '/' . $ads->ad_id,
                    $params,
                    $account->access_token
                );
                return $fbAds->getGraphNode();
            }
        } catch (FacebookResponseException $e) {
            return ['error' => $e->getResponseData()];
        } catch (FacebookSDKException $e) {
            return ['error' => $e->getResponseData()];
        }
    }
}
