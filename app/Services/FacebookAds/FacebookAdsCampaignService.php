<?php
namespace App\Services\FacebookAds;

use App\Services\CRUDService;
use App\Services\CurlService;
use App\SocialAccount;
use App\FacebookAdsSocialAccount;
use App\FacebookAdsCampaign;
use Yajra\DataTables\DataTables;
use App\Jobs\CrawlFacebookAdsSetJob;
use Carbon\Carbon;
use Log;
use DB;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Storage;
use App\Services\FacebookAds\FacebookAdsSetService;

class FacebookAdsCampaignService extends CRUDService
{
    private $curlService = null;
    private $fb = null;
    private $facebookAdsSetService = null;
    public function __construct(
        CurlService $curlService,
         FacebookAdsSetService $facebookAdsSetService
    ) {
        parent::__construct(FacebookAdsCampaign::class);
        $this->curlService = $curlService;
         $this->facebookAdsSetService = $facebookAdsSetService;
        $this->fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_version'),
        ]);
    }

    public function getData($request)
    {
        $campaigns = $this->listByConditions(
            ['ad_account_id' => $request->id],
            [],
            'start_time',
            'DESC'
        );
        $dt = DataTables::of($campaigns)
            ->editColumn('name', function ($item) {
                return '<a class="text-hover-primary text-dark-75 font-weight-bolder mb-1 font-size-lg">'.$item->name.'</a>';
            })
            ->editColumn('actions', function ($item) {
                $html = '';
                $html .= '<span class="svg-icon svg-icon-md">
                            <a href="/facebook-ads/campaigns/'.$item->id.'/delete">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                            </a>
                        </span>';
                $html .= '<span class="text__delete warehouse__action"><a href="/facebook-ads/campaigns/'.$item->id.'/delete' . '" class="btn-delete">
                            Xóa
                        </a></span>';
                return $html;
            })
            ->rawColumns(['name', 'actions']);
        return $dt->make(true);
    }

    public function saveCampaign($campaign, $accountId, SocialAccount $socialAccount)
    
    {
        
        
        $result = $this->updateOrCreate([
            'campaign_id' => $campaign->id,
            'ad_account_id' => $accountId,
            'social_id' => $socialAccount->id,
            'user_id' => auth()->id()
        ], [
            'campaign_id' => $campaign->id,
            'ad_account_id' => $accountId,
            'social_id' => $socialAccount->id,
            'user_id' => auth()->id(),
            'name' => $campaign->name,
            'objective' => $campaign->objective,
            'created_time' => $campaign->created_time,
            'start_time' => $campaign->start_time,
            'stop_time' => $campaign->stop_time ?? null,
            'status' => $campaign->status
        ]);
         
            
         
         
        return $result;
    }

    public function getAllCampaigns(FacebookAdsSocialAccount $account, $enablePagination = false)
    {
        $socialAccount = $account->social_account;
       
        $url = 'https://graph.facebook.com/' . config('facebook.app_version') . '/' . $socialAccount->social_id . '/campaigns?fields=id,name,objective,created_time,start_time,stop_time,status&access_token=' . $socialAccount->access_token;

        $result = $this->curlService->sendGetRequestApi($url);
        
        $result = json_decode($result);
        
        if ($result && isset($result->data)) {
            $campaigns = $result->data;
        

            for ($i = 0; $i < count($campaigns); $i++) {
               $d = $campaigns[$i];
               $campaign = $this->saveCampaign($d, $account->id, $socialAccount);
             
              $this->facebookAdsSetService->getAllAdsSets($campaign, $socialAccount->access_token);
              //CrawlFacebookAdsSetJob::dispatch($campaign, $socialAccount->access_token)->onQueue('crawl_facebook_ads_set');
            }
        }
    }
    
   
}
