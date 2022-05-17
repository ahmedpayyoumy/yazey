<?php
namespace App\Services\FacebookAds;

use App\Services\CRUDService;
use App\Services\CurlService;
use App\SocialAccount;
use App\FacebookAdsSet;
use App\FacebookAdsInsight;
use Carbon\Carbon;
use Log;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FacebookAdsInsightsService extends CRUDService
{
    private $curlService = null;

    public function __construct(
        CurlService $curlService
    ) {
        parent::__construct(FacebookAdsInsight::class);
        $this->curlService = $curlService;
    }

    public function getTotalAccountSpend(SocialAccount $account)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/'.$account->social_id.'/insights/?date_preset=maximum&fields=spend&access_token='.$account->access_token;
        return $this->curlService->sendGetRequestApi($url);
    }

    public function getTotalAdsSetSpend(FacebookAdsSet $adsSet)
    {
        $account = $adsSet->social_account;
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/'.$adsSet->ad_set_id.'/insights/?date_preset=maximum&fields=spend&access_token='.$account->access_token;
        return $this->curlService->sendGetRequestApi($url);
    }

    public function getAccountSpendByDate(SocialAccount $account, $start, $end)
    {
        // $start= "2018-10-05";
        // $end = "2021-11-05";
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/'.$account->social_id.'/insights/?time_range[since]='.$start.'&time_range[until]='.$end.'&fields=spend,impressions,buying_type,clicks,reach,frequency,cost_per_inline_link_click&access_token='.$account->access_token;
          
        return $this->curlService->sendGetRequestApi($url);
    }

    public function listByYear($accountId, $year = null)
    {
        if (!$year) {
            $year = now()->format('Y');
        }
        $insights = $this->getModel()->where([
            'ad_account_id' => $accountId
        ])
        ->whereYear('date', $year)
        ->orderBy('date', 'asc')
        ->selectRaw('
            spend
        ')
        ->pluck('spend');
        return $insights;
    }

    public function crawlInsights(SocialAccount $account)
    {
        
       
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromFormat('m', $month);
            $start = $date->copy()->startOfMonth()->format('Y-m-d');
            $end = $date->copy()->endOfMonth()->format('Y-m-d');
            $spend = json_decode($this->getAccountSpendByDate($account, $start, $end));
           
            if (isset($spend->data) && count($spend->data)) {
                $data = $spend->data;
                $spend = $data[0]->spend;
                $impressions = $data[0]->impressions;
                $reach = $data[0]->reach;
                $clicks = $data[0]->clicks;
                $frequency = $data[0]->frequency;
                $cost_per_inline_link_click = $data[0]->cost_per_inline_link_click;
                $this->updateOrCreate([
                    'date' => $date->copy()->startOfMonth(),
                    'ad_account_id' => $account->id
                ], [
                    'date' => $date->copy()->startOfMonth(),
                    'ad_account_id' => $account->id,
                    'spend' => $spend,
                    'impressions' => $impressions,
                    'reach' => $reach,
                    'clicks' => $clicks,
                    'frequency' => $frequency,
                    'cost_per_inline_link_click' => $cost_per_inline_link_click
                ]);
            } else {
                $this->updateOrCreate([
                    'date' => $date->copy()->startOfMonth(),
                    'ad_account_id' => $account->id
                ], [
                    'date' => $date->copy()->startOfMonth(),
                    'ad_account_id' => $account->id,
                    'spend' => 0,
                    'impressions' => 0,
                    'reach' => 0,
                    'clicks' => 0,
                    'frequency' => 0,
                    'cost_per_inline_link_click' =>0
                ]);
            }
        }
    }
}
