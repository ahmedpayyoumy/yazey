<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialAccount\GoogleAnalyticsService;
use App\Services\UserSelectedAccount\UserSelectedAccountService;
use App\DataSource;

class GoogleAnalyticsController extends Controller
{
    //
    private $ggAnalyticsService = null;
    private $userSelectAccountService = null;

    public function __construct(
        GoogleAnalyticsService $ggAnalyticsService,
        UserSelectedAccountService $userSelectAccountService
    ) {
        $this->ggAnalyticsService = $ggAnalyticsService;
        $this->userSelectAccountService = $userSelectAccountService;
    }

    public function index()
    {
        try {
            $totalAccount = $this->ggAnalyticsService->count(['user_id' => auth()->id()]);
            $accounts = $this->ggAnalyticsService->listAccounts(['user_id' => auth()->id()]);
            $client = $this->ggAnalyticsService->getClient();
            foreach ($accounts as $account) {
                $client->refreshToken($account->access_token);
            }
            $websiteUrls = $this->ggAnalyticsService->getListWebsiteUrl($client);
            $userSelectAccount = $this->userSelectAccountService->firstRow(['user_id' => auth()->id()]);
            $isDisabledSelectBtn = $userSelectAccount && $userSelectAccount->view_id;
            if (is_array($websiteUrls) && count($websiteUrls)) {
                foreach ($websiteUrls as &$websiteUrl) {
                    if ($userSelectAccount && $userSelectAccount->view_id == $websiteUrl['view_id']) {
                        $websiteUrl['is_selected'] = true;
                    } else {
                        $websiteUrl['is_selected'] = false;
                    }
                }
            }
            return view('google-analytics.list')->with([
                "accounts" => $accounts,
                "totalAccount" => $totalAccount,
                "websiteUrls" => $websiteUrls,
                "isDisabledSelectBtn" => $isDisabledSelectBtn
            ]);
        } catch (\Exception $e) {
            $totalAccount = $this->ggAnalyticsService->count(['user_id' => auth()->id()]);
            $accounts = $this->ggAnalyticsService->listAccounts(['user_id' => auth()->id()]);
            $websiteUrls = [];
            return view('google-analytics.list')->with([
                "accounts" => $accounts,
                "totalAccount" => $totalAccount,
                "websiteUrls" => $websiteUrls,
                "isDisabledSelectBtn" => false
            ]);
        }
    }

    public function add()
    {
        $client = $this->ggAnalyticsService->getClient();
        return $this->ggAnalyticsService->getAuthUrl($client);
    }

    public function callback(Request $request)
    {
        try {
            // Get an access token
            $totalAccount = $this->ggAnalyticsService->count(['user_id' => auth()->id()]);
            // if ($totalAccount == 0) {
            $client = $this->ggAnalyticsService->getClient();
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);
            $refreshToken = $client->getRefreshToken();

            $accounts = $this->ggAnalyticsService->getAccountSummaries($client);

            $this->ggAnalyticsService->saveGGAnalyticsAccessToken(['username' => $accounts->username, 'access_token' => $refreshToken]);


            return redirect('/google-analytics/accounts')->with([
                    'success' => 'Add Google Analytics account successfully.'
                ]);
            // }

            // return redirect('/google-analytics/accounts')->back();
        } catch (\Exception $e) {
            return redirect('/google-analytics/accounts')->with([
                'danger' => $e->getMessage()
            ]);
        }
    }

    public function detail($id)
    {
        $account = $this->ggAnalyticsService->firstRow(['id' => $id]);
        $client = $this->ggAnalyticsService->getClient();

        $client->refreshToken($account->access_token);
        try {
            $result = $this->ggAnalyticsService->getAnalyticsResult($client);
            return view('google-analytics.dashboard')->with([
                'id' => $id,
                'result' => $result[0]
            ]);
        } catch (\Exception $e) {
            return view('google-analytics.dashboard')->with([
                'id' => $id,
                'result' => [
                    'website_url' => '',
                    'data' => [
                        'users' => 0,
                        'newUsers' => 0,
                        'sessions' => 0,
                        'avgSessionDuration' => 0,
                        'bounceRate' => 0,
                        'active_visitors' => 0,
                        'visitors_30' => [],
                        'users' => 0,
                        'sessions' => 0,
                        'avgSessionDuration' => 0,
                        'bounceRate' => 0,
                        'sources' => [],
                        'devices' => [],
                        'countries' => []
                    ]
                ]
            ]);
        }
    }

    public function delete($id)
    {
        $this->ggAnalyticsService->deleteAccount($id);
        return redirect('/google-analytics/accounts')->with([
            'success' => 'Delete Google Analytics account successfully.'
        ]);
    }

    public function selectWebsite(Request $request)
    {
        try {
            $account = $this->ggAnalyticsService->firstRow([
                'user_id' => auth()->id(),
                'data_source_id' => DataSource::GOOGLE_ANALYTICS
            ]);
            if (!$account) {
                return redirect()->back()->with([
                    'danger' => 'Google Account does not exist'
                ]);
            }
            $viewId = $request->select_website_url;
            $userSelectAccount = $this->userSelectAccountService->updateOrCreate([
                'user_id' => auth()->id()
            ], [
                'user_id' => auth()->id(),
                'industry_id' => auth()->user()->industry->id,
                'google_analytics_account_id' => $account->id,
                'view_id' => $viewId
            ]);
            return redirect()->back()->with([
                'success' => 'Select website successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
