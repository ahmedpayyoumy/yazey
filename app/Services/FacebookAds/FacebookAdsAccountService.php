<?php
namespace App\Services\FacebookAds;

use App\Services\SocialAccount\SocialAccountService;
use App\Services\CurlService;
use App\SocialAccount;
use App\DataSource;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use App\Services\FacebookAds\FacebookAdsCampaignService;
use App\Services\FacebookAds\FacebookAdsInsightsService;

class FacebookAdsAccountService extends SocialAccountService
{
    private $curlService = null;
    private $fbAdsCampaignService;
    private $fbAdsInsightsService;

    public function __construct(
        CurlService $curlService,
        FacebookAdsCampaignService $fbAdsCampaignService,
        FacebookAdsInsightsService $fbAdsInsightsService
    ) {
        parent::__construct();
        $this->curlService = $curlService;
        $this->fbAdsCampaignService = $fbAdsCampaignService;
        $this->fbAdsInsightsService = $fbAdsInsightsService;
    }

    public function listAccounts($conditions = [])
    {
        return $this->listBySource(DataSource::FACEBOOK_ADS, $conditions);
    }

    public function getListAdsAccounts($accessToken)
    {
        $fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_version'),
        ]);
     
        try {
            $response = $fb->get('/me/adaccounts?fields=id,account_id,name', $accessToken);
         
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        $accounts = $response->getGraphEdge()->asArray();
        return $accounts;
    }

    public function updateLongliveAccesstoken($accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/oauth/access_token?grant_type=fb_exchange_token&client_id='.config('facebook.app_id').'&client_secret='.config('facebook.app_secret').'&fb_exchange_token='.$accessToken;
        
        return $this->curlService->sendGetRequestApi($url);
    }

    public function addAdsAccount($accountObj, $userID)
    {
        //
      
        // $companyId = session('company_id');
        $account = $this->firstRow([
            'social_id' => $accountObj->id,
            'data_source_id' => DataSource::FACEBOOK_ADS
        ]);

        $isNewAccount = !$account;

        if ($isNewAccount) {
            $account = $this->create([
                'social_id' => $accountObj->id,
                'data_source_id' => DataSource::FACEBOOK_ADS,
                'user_id' => auth()->id(),
                'name' => $accountObj->name
            ]);
            $account->facebook_ads_social_account()->create([
                'account_id' => $accountObj->id,
                'social_account_id' => $account->id
            ]);
        }
        $account->update([
            'access_token' => $accountObj->access_token,
        ]);

 
        $resp = $this->updateLongliveAccesstoken($account->access_token);
      
        $resp = json_decode($resp);

        try {
            $account->access_token = $resp->access_token;
            $account->note = 'Cập nhật token thành công';
        } catch (\Exception $e) {
            if ($account) {
                $account->note = isset($resp->error) ? $resp->error->message : $e->getMessage();
            }
        }
        $account->save();

     
     
     
     
        $fbAdsAccount = $account->facebook_ads_social_account;
         
       
        if ($fbAdsAccount) {
            // TODO: Get spend
            $spend = json_decode($this->fbAdsInsightsService->getTotalAccountSpend($account));
          
            if (isset($spend) && isset($spend->data) && count($spend->data)) {
                $fbAdsAccount->update([
                    'spend' => $spend->data[0]->spend
                ]);
            }
             
            $this->fbAdsInsightsService->crawlInsights($account);
        
         $this->fbAdsCampaignService->getAllCampaigns($fbAdsAccount, false);
        }
    }

    public function deleteAccount($id)
    {
        $account = $this->firstRow([
            'id' => $id,
            'data_source_id' => DataSource::FACEBOOK_ADS
        ]);
        if ($account) {
            $account->delete();
        }
    }
}
