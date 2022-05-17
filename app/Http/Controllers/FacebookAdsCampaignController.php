<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacebookAds\FacebookAdsAccountService;
use App\Services\FacebookAds\FacebookAdsCampaignService;

class FacebookAdsCampaignController extends Controller
{
    //
    private $fbAdsAccountService = null;
    private $fbAdsCampaignService = null;

    public function __construct(
        FacebookAdsAccountService $fbAdsAccountService,
        FacebookAdsCampaignService $fbAdsCampaignService
    ) {
        $this->fbAdsAccountService = $fbAdsAccountService;
        $this->fbAdsCampaignService = $fbAdsCampaignService;
    }

    public function listCampaigns($id)
    {
        $fbAdsAccount = $this->fbAdsAccountService->firstRow(['id' => $id]);
        if (!$fbAdsAccount) {
            return redirect()->back();
        }
        return view('facebook-ads.list-campaign')->with([
            'socialId' => $id,
            'accountId' => $fbAdsAccount->facebook_ads_social_account->id
        ]);
    }

    public function getDataCampaigns(Request $request)
    {
        try {
            return $this->fbAdsCampaignService->getData($request);
        } catch (\Exception $e) {
        }
    }

    public function deleteCampaign($id)
    {
        
        
        try {
            $campaign = $this->fbAdsCampaignService->firstRowByConditions(
                ['id' => $id]
            );
      
            
            if (!$campaign) {
                return redirect()->back();
            }
            $account = $campaign->social_account;
            $response = $this->fbAdsCampaignService->deleteCampaign($account, $campaign);
            
            if ($response) {
                $campaign->delete();
            }
            return redirect()->back();
        } catch (\Exception $e) {
        }
    }
}
