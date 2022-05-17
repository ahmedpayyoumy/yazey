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
use App\SocialAccount;

class CronController extends Controller
{
    //
    private $fbAdsInsightsService = null;
    private $fbAccountService = null;
    private $fbAdsAccountService = null;
    private $userSelectAccountService = null;
    private $facebookAdsDataMonthly=null;
    private $facebookAdsCampaign=null;
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

  public function getAccountSpendByDate($account, $start, $end,$accessToken)
    {
        // $start= "2018-10-05";
        // $end = "2021-11-05";
       
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/'.$account->campaign_id.'/insights/?time_range[since]='.$start.'&time_range[until]='.$end.'&fields=account_currency,spend,impressions,buying_type,clicks,reach,frequency,cost_per_inline_link_click&access_token='.$accessToken;
     
        return $this->curlService->sendGetRequestApi($url);
    }
    
       public function updateLongliveAccesstoken($accessToken)
   {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/oauth/access_token?grant_type=fb_exchange_token&client_id='.config('facebook.app_id').'&client_secret='.config('facebook.app_secret').'&fb_exchange_token='.$accessToken;
        
        return $this->curlService->sendGetRequestApi($url);
    }

    public function cronToken()
    {
     
        try {
        $all_campagin=$this->facebookAdsCampaign::where([
        ['status', '=', 'ACTIVE']
       ])->get();
   

          
         if($all_campagin){
                foreach ($all_campagin as $all_campagins) {
                    $campagin_id=$all_campagins->campaign_id;
                    $user_id=$all_campagins->user_id;
                    $social_id=$all_campagins->social_id;
                   
                    $user=SocialAccount::where('user_id','=',$user_id)->first();
                    $access_token=$user->access_token;
                    
             if($access_token!=null){
              for ($month = 1; $month <= 12; $month++) {
              $date = Carbon::createFromFormat('m', $month);
              $start = $date->copy()->startOfMonth()->format('Y-m-d');
              $end = $date->copy()->endOfMonth()->format('Y-m-d');
              $accessToken_decode=$this->updateLongliveAccesstoken($access_token);
              
              $token=json_decode($accessToken_decode);
              $accessToken=$token->access_token;
           
              $spend = json_decode($this->getAccountSpendByDate($all_campagins, $start, $end,$accessToken));
           
           
              if (isset($spend->data) && count($spend->data)) {
                $data = $spend->data;
                $spend = $data[0]->spend;
                $account_currency= $data[0]->account_currency;
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
                    'user_id' =>$user_id,
                    'social_id' =>$social_id,
                    'campaign_id' => $campagin_id,
                    'spend' => $spend,
                    'impressions' => $impressions,
                    'reach' => $reach,
                    'clicks' => $clicks,
                    'frequency' => $frequency,
                    'cost_per_inline_link_click' => $cost_per_inline_link_click,
                    'account_currency'=>$account_currency,
                    'roas'=>0
                ]);
            }
            
           }
            }else{
                
               echo "echo somthing went Wrong";
               
            }
        }
             
         }
         
        }catch (\Exception $e) {
            
            echo "echo somthing went Wrong";
            
        }
        

    }

   
}
