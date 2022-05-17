<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Redirect;
use App\SocialAccount;
use App\User;
use App\FacebookPage;
use App\Services\SocialFacebookAccountService;
use App\Services\SocialAccount\FacebookAccountService;
use App\Services\FacebookAds\FacebookAdsAccountService;
use App\Services\FacebookAds\FacebookAdsInsightsService;
use App\Services\UserSelectedAccount\UserSelectedAccountService;


class FBAuthController extends Controller
{
    private $fbAdsAccountService;
    private $fbAdsInsightsService;
    private $userSelectAccountService;
    private $fbAccountService;

    public function __construct(
        FacebookAccountService $fbAccountService,
        FacebookAdsAccountService $fbAdsAccountService, 
        FacebookAdsInsightsService $fbAdsInsightsService, 
        UserSelectedAccountService $userSelectAccountService
    ) {
        $this->fbAdsAccountService = $fbAdsAccountService;
        $this->fbAdsInsightsService = $fbAdsInsightsService;
        $this->userSelectAccountService = $userSelectAccountService;
        $this->fbAccountService = $fbAccountService;

    }
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }    
    /**
    * Return a callback method from facebook api.
    *
    * @return callback URL from facebook
    */
    public function callback(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
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
        // dd($accounts, $pages);
        // $pages = $fbAccountService->getListAdminPage($user->token);
        // auth()->login($user);
        // return redirect()->to('/home');
        return redirect('facebook-ads/accounts')->with([
            'accounts' => $accounts,
            'pages' => $pages,
            'isDisabledSelectBtn' => $isDisabledSelectBtn
        ]);
    }


    public function register(Request $request)
    {
        $token = $request->request1['authResponse']['accessToken'];
        $id = $request->request1['authResponse']['userID'];
        $name = $request->request2['name'];
        $email = isset($request->request2['email']) ? $request->request2['email'] : null;
        $avatar = $request->request2['picture']['data']['url'];

        $account = SocialAccount::where('social_id', '=', $id)->first();
        $userfb = User::where('fb_id', '=', $id)->first();

        if($userfb){
            $user = $userfb;
        } else {
            $user = User::create([
                "name" => $name,
                "email" => $email,
                "is_verify" => 1,
                "fb_id" => $id,
                "avatar" => $avatar,
                "is_active" => 1,
                "is_new" => 0,
                'permission' => 'dashboard_roas,dashboard_sales,dashboard_traffic,dashboard_past_year_sales,agency_spy,roas_performenance,industry_average,roas_ranking_table,rank_no,monthly_traffic,monthly_sale,marketing_spend,marketing_roas'
            ]);
        }

        if (!$account) {
            $account = SocialAccount::create([
                'name' => $name,
                'logo_src' => $avatar,
                'social_id' => $id,
                'access_token' => $token,
                'data_source_id' => $id,
                'user_id' => $user->id,
            ]);
            $data['socialUser'] = $account;
        } else {
            $data['socialUser'] = $account;
        }

        auth()->login($user);
        $data['user'] = $user;
        return true;
    }

    public function fbregisterPage(Request $request)
    {
        $token = $request->payload['data'][0]['access_token'];
        $name = $request->payload['data'][0]['name'];
        $id = $request->payload['data'][0]['id'];
        $avatar = $request->payload['data'][0]['picture']['data']['url'];
        $website = isset($request->payload['data'][0]['website']) ? $request->payload['data'][0]['website'] : null;


        $page = FacebookPage::where('page_id', $id)->first();
        if (!$page) {
            $page = new FacebookPage;
            $page->name = $name;
            $page->avatar = $avatar;
            $page->page_id = $id;
            $page->website = $website;
            $page->access_token = $token;
            $page->user_id = auth()->id();
            $page->save();
        }
        $page = $this->fbAccountService->firstRow([
            'page_id' => $id,
            'user_id' => auth()->id()
        ]);
        if (!$page) {
            return "bad";
        }
        $userSelectAccount = $this->userSelectAccountService->updateOrCreate([
            'user_id' => auth()->id()
        ], [
            'user_id' => auth()->id(),
            'industry_id' => auth()->user()->industry->id,
            'facebook_ads_account_id' => $page->social_id,
            // 'ad_set_id' => $page->ad_set_id,
            'page_id' => $id
        ]);
        return "good";
    }
}
