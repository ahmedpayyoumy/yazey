<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacebookAds\FacebookAdsAccountService;
use App\Services\FacebookAds\FacebookAdsInsightsService;
use App\Services\SocialAccount\GoogleAnalyticsService;
use App\Services\SocialAccount\FacebookAccountService;
use App\Services\UserSelectedAccount\UserSelectedAccountService;
use App\Services\ROAS\RoasReportService;
use App\FacebookAdsDataMonthly;
use Carbon\Carbon;
use DB;
use Auth;

class DashboardController extends Controller
{
    //
    private $fbAccountService = null;
    private $fbAdsAccountService = null;
    private $fbAdsInsightsService = null;
    private $userSelectAccountService = null;
    private $ggAnalyticsService = null;
    private $roasReportService = null;
    private  $facebookAdsDataMonthly = null;
    public function __construct(
        FacebookAccountService $fbAccountService,
        FacebookAdsAccountService $fbAdsAccountService,
        FacebookAdsInsightsService $fbAdsInsightsService,
        UserSelectedAccountService $userSelectAccountService,
        GoogleAnalyticsService $ggAnalyticsService,
        RoasReportService $roasReportService,
        FacebookAdsDataMonthly $facebookAdsDataMonthly
    ) {
        $this->fbAccountService = $fbAccountService;
        $this->fbAdsAccountService = $fbAdsAccountService;
        $this->fbAdsInsightsService = $fbAdsInsightsService;
        $this->userSelectAccountService = $userSelectAccountService;
        $this->ggAnalyticsService = $ggAnalyticsService;
        $this->roasReportService = $roasReportService;
        $this->facebookAdsDataMonthly = $facebookAdsDataMonthly;
    }

    public function getSiteTraffic($domain)
    {
        // Register for an API key here https://app.sitetrafficapi.com/register/
       $apikey = "101c173868530db19c98f3d0b066f10f87deaa47";
    
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, "https://endpoint.sitetrafficapi.com/pay-as-you-go/?key=".trim($apikey)."&host=".$domain);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_HEADER, 0);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
       curl_setopt($ch, CURLOPT_TIMEOUT, 30);
       $result = curl_exec($ch);
       curl_close($ch);
    
       $json = json_decode($result, true);
    
       echo "Domain: <strong>".htmlspecialchars($domain)."</strong><br />";
    
       if(!isset($json['error']))
       {
           return htmlspecialchars($json['data']['estimations']['pageviews']['monthly']);
       }
       else
       {
           return "API Error: ".htmlspecialchars($json['error'])."<br />";
       }
    
    }

    public function index(Request $request)
    {
        $accounts = $this->fbAdsAccountService->listAccounts();
        $totalSpend = 0;
        $insights = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $totalUsers = $totalPurchases = 0;
        $userIndustry = auth()->user()->industry;
        $selectedAccount = $gaSelectedViewId = null;
        $userSelectAccount = null;
        try {
            if (count($accounts)) {
                $account = $accounts[0]->facebook_ads_social_account;
                $totalSpend = 0;
                $insights = $this->fbAdsInsightsService->listByYear($account->id);
                $date = Carbon::createFromFormat('m', date('m'));
                if(isset(Auth::user()->facebook_page[0]->website)){
                    $month = $this->facebookAdsDataMonthly::where('date', $date->copy()->startOfMonth())->where('user_id', Auth::id())->first();
                    if($month->traffic == null){
                        $siteTraffic = $this->getSiteTraffic(Auth::user()->facebook_page[0]->website);
                        $this->facebookAdsDataMonthly::whereId($month->id)->update(["traffic" => $siteTraffic]);
                    } else {
                        $siteTraffic = $month->traffic;
                    }
                } else {
                    $siteTraffic = 0;
                }
                $lastMonth = $this->facebookAdsDataMonthly::where('date', $date->copy()->subMonth()->startOfMonth())->where('user_id', Auth::id())->first();

                $userSelectAccount = $this->userSelectAccountService->firstRow(['user_id' => auth()->id()]);
                if ($userSelectAccount) {
                    $pageId = $userSelectAccount->page_id;
                    if ($pageId) {
                        $page = $this->fbAccountService->firstRow(['page_id' => $pageId]);

                        $adsSets = $page->ads_sets;
                        foreach ($adsSets as $adsSet) {
                            $totalSpend += $adsSet->spend;
                        }
                    }

                    $fbAdAccount = $userSelectAccount->facebook_ads_account;
                    if ($fbAdAccount) {
                        $selectedAccount = $fbAdAccount->social_id;
                    }
                    $gaSelectedViewId = $userSelectAccount->view_id;
                    if ($gaSelectedViewId && $userSelectAccount->google_analytics_account_id) {
                        $totalUsers = $this->ggAnalyticsService->getTotalUsers(
                            $userSelectAccount->google_analytics_account_id,
                            $userSelectAccount->view_id
                        );
                        $totalPurchases = $this->ggAnalyticsService->getTotalPurchases(
                            $userSelectAccount->google_analytics_account_id,
                            $userSelectAccount->view_id
                        );
                    }
                }
            }

            $page = $request->query('page') ? $request->query('page') : 1;
            // $reports = $this->roasReportService->getReportWithPagination($page);

            // old query    $reports = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE facebook_ads_data_mothlys.user_id != '".auth()->id()."' AND MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and   users.id = facebook_ads_data_mothlys.user_id and   industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id ORDER BY  AVG(roas) DESC ");
            // $reports = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE  MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and   users.id = facebook_ads_data_mothlys.user_id and   industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id ORDER BY  AVG(roas) DESC ");

            $reports = DB::select("SELECT facebook_ads_data_mothlys.*,
                                SUM(facebook_ads_data_mothlys.cost_per_inline_link_click) AS avg_cpc,
                                SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,
                                SUM(facebook_ads_data_mothlys.reach) AS reach_total,
                                SUM(facebook_ads_data_mothlys.spend) AS spend_total,
                                users.industry_id,
                                industries.name as industriesname,
                                users.marketing_type 
                                FROM `facebook_ads_data_mothlys`, `users`, `industries` 
                                WHERE  MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and 
                                users.id = facebook_ads_data_mothlys.user_id and
                                industries.id = users.industry_id 
                                GROUP BY facebook_ads_data_mothlys.user_id 
                                ORDER BY  AVG(roas) DESC");
            // dd($reports);
            $current_user_reports = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.cost_per_inline_link_click) AS avg_cpc,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE  MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and   users.id = facebook_ads_data_mothlys.user_id and   industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id  ORDER BY AVG(roas) DESC");


            $total_spend_data = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.roas) AS roas_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE YEAR(facebook_ads_data_mothlys.date) = YEAR(CURRENT_DATE()) and facebook_ads_data_mothlys.user_id = '" . auth()->id() . "' and users.id = facebook_ads_data_mothlys.user_id and industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id");
            $has_user = DB::select("SELECT id from facebook_ads_data_mothlys where user_id = '" . auth()->id() . "'");
            $yearly_spend = DB::select("SELECT * from facebook_ads_data_mothlys WHERE facebook_ads_data_mothlys.user_id ='" . auth()->id() . "' AND YEAR(facebook_ads_data_mothlys.date) = YEAR(CURRENT_DATE())");

            //current user industry everage
            $industry_id = Auth::user()->industry_id;
            $industry_name = "";
            $industry_everage = "";
            if ($industry_id) {
                $everage = DB::select("SELECT id FROM `users` WHERE industry_id ='" . $industry_id . "'");
                $industry_name = DB::select("SELECT name FROM `industries` WHERE id ='" . $industry_id . "'");
                $var_average = [];
                foreach ($everage as $everages) {
                    array_push($var_average, $everages->id);
                }
                if ($var_average) {
                    $impload_average = '' . implode('", "', $var_average) . '';
                    $industry_everage = DB::select('SELECT ROUND(AVG(roas),2) as total_roas_everage from facebook_ads_data_mothlys where user_id IN ("' . $impload_average . '") GROUP BY MONTH(date)');
                }
            }

            //All users industry everage
            $industry_everage_all_user = "";

            $everage_all_user = DB::select("SELECT id FROM `users`");
            $var_average_all_user = [];
            foreach ($everage_all_user as $everage_all_users) {
                array_push($var_average_all_user, $everage_all_users->id);
            }

            if ($var_average_all_user) {
                $impload_average_all_users = '' . implode('", "', $var_average_all_user) . '';
                $industry_everage_all_user = DB::select('SELECT ROUND(AVG(roas),2) as total_roas_everage from facebook_ads_data_mothlys where user_id IN ("' . $impload_average_all_users . '") GROUP BY MONTH(date)');
            }

            $fullUrl = explode('?', $_SERVER['REQUEST_URI']);
            $currUrl = $fullUrl[0];
            return view('dashboard.index')->with([
                'accounts' => $accounts,
                'selectedAccount' => $selectedAccount,
                'gaSelectedViewId' => $gaSelectedViewId,
                'totalSpend' => $totalSpend,
                'insights' => $insights,
                'totalUsers' => $totalUsers,
                'totalPurchases' => $totalPurchases,
                'userIndustry' => $userIndustry ? $userIndustry->name : '',
                'userSelectAccount' => $userSelectAccount,
                'reports' => $reports,
                'current_user_reports' => $current_user_reports,
                'total_spend_data' => $total_spend_data,
                'currUrl' => $currUrl,
                'yearly_spend' => $yearly_spend,
                'industry_everage' => $industry_everage,
                'industry_everage_all_user' => $industry_everage_all_user,
                'industry_name' => $industry_name,
                'has_user' => $has_user,
                'siteTraffic' => $siteTraffic,
                'lastMonthData' => $lastMonth
            ]);
        } catch (\Exception $e) {
            if (count($accounts)) {
                $account = $accounts[0]->facebook_ads_social_account;
                $totalSpend = 0;
                $insights = $this->fbAdsInsightsService->listByYear($account->id);
                $userSelectAccount = $this->userSelectAccountService->firstRow(['user_id' => auth()->id()]);
                if ($userSelectAccount) {
                    $pageId = $userSelectAccount->page_id;
                    if ($pageId) {
                        $page = $this->fbAccountService->firstRow(['page_id' => $pageId]);
                        $adsSets = $page->ads_sets;
                        foreach ($adsSets as $adsSet) {
                            $totalSpend += $adsSet->spend;
                        }
                    }

                    $fbAdAccount = $userSelectAccount->facebook_ads_account;
                    if ($fbAdAccount) {
                        $selectedAccount = $fbAdAccount->social_id;
                    }
                    // if ($userSelectAccount->google_analytics_account_id) {
                    //     $totalUsers = $this->ggAnalyticsService->getTotalUsers(
                    //         $userSelectAccount->google_analytics_account_id,
                    //         $userSelectAccount->view_id
                    //     );
                    // }
                }
            }

            $page = $request->query('page') ? $request->query('page') : 1;
            // $reports = $this->roasReportService->getReportWithPagination($page);
            $reports = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE facebook_ads_data_mothlys.user_id != '" . auth()->id() . "' AND MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and   users.id = facebook_ads_data_mothlys.user_id and   industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id ORDER BY  AVG(roas) DESC");


            $current_user_reports = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and   users.id = facebook_ads_data_mothlys.user_id and   industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id ORDER BY AVG(roas) DESC");

            $total_spend_data = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.roas) AS roas_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE YEAR(facebook_ads_data_mothlys.date) = YEAR(CURRENT_DATE()) and facebook_ads_data_mothlys.user_id = '" . auth()->id() . "' and users.id = facebook_ads_data_mothlys.user_id and industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id");

            $yearly_spend = DB::select("SELECT * from facebook_ads_data_mothlys WHERE facebook_ads_data_mothlys.user_id ='" . auth()->id() . "' AND YEAR(facebook_ads_data_mothlys.date) = YEAR(CURRENT_DATE())");
            $has_user = DB::select("SELECT id FROM facebook_ads_data_mothlys where user_id= '" . auth()->id() . "'");
            //current user industry everage
            $industry_id = Auth::user()->industry_id;
            $industry_everage = "";
            $industry_name = "";
            if ($industry_id) {
                $everage = DB::select("SELECT id FROM `users` WHERE industry_id ='" . $industry_id . "'");
                $industry_name = DB::select("SELECT name FROM `industries` WHERE id ='" . $industry_id . "'");
                $var_average = [];
                foreach ($everage as $everages) {
                    array_push($var_average, $everages->id);
                }
                if ($var_average) {
                    $impload_average = '' . implode('", "', $var_average) . '';
                    $industry_everage = DB::select('SELECT  ROUND(AVG(roas),2) as total_roas_everage from facebook_ads_data_mothlys where user_id IN ("' . $impload_average . '") GROUP BY MONTH(date)');
                }
            }

            //All users industry everage
            $industry_everage_all_user = "";

            $everage_all_user = DB::select("SELECT id FROM `users`");
            $var_average_all_user = [];
            foreach ($everage_all_user as $everage_all_users) {
                array_push($var_average_all_user, $everage_all_users->id);
            }

            if ($var_average_all_user) {

                $impload_average_all_users = '' . implode('", "', $var_average_all_user) . '';
                $industry_everage_all_user = DB::select('SELECT ROUND(AVG(roas),2) as total_roas_everage from facebook_ads_data_mothlys where user_id IN ("' . $impload_average_all_users . '") GROUP BY MONTH(date)');
            }


            $fullUrl = explode('?', $_SERVER['REQUEST_URI']);
            $currUrl = $fullUrl[0];
            return view('dashboard.index')->with([
                'accounts' => $accounts,
                'selectedAccount' => $selectedAccount,
                'gaSelectedViewId' => $gaSelectedViewId,
                'totalSpend' => $totalSpend,
                'insights' => $insights,
                'totalUsers' => $totalUsers,
                'totalPurchases' => $totalPurchases,
                'userIndustry' => $userIndustry ? $userIndustry->name : '',
                'userSelectAccount' => $userSelectAccount,
                'reports' => $reports,
                'current_user_reports' => $current_user_reports,
                'total_spend_data' => $total_spend_data,
                'currUrl' => $currUrl,
                'yearly_spend' => $yearly_spend,
                'industry_everage' => $industry_everage,
                'industry_everage_all_user' => $industry_everage_all_user,
                'industry_name' => $industry_name,
                'has_user' => $has_user
            ]);
        }
    }

    public function agency(Request $request)
    {


        return view('agency.index');
    }

    public function connect_data(Request $request)
    {


        return view('connect.index');
    }

    public  function load_data(Request $request)
    {
        if ($request->ajax()) {
            $data_limit = $request->id + 5;
            if ($request->id > 0) {
                //   $data = DB::table('post')
                //       ->where('id', '<', $request->id)
                //       ->orderBy('id', 'DESC')
                //       ->limit(5)
                //       ->get();

                $data = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE facebook_ads_data_mothlys.user_id != '" . auth()->id() . "' AND MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and   users.id = facebook_ads_data_mothlys.user_id and   industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id ORDER BY  AVG(roas) DESC");
            } else {
                $data = DB::select("SELECT facebook_ads_data_mothlys.*,SUM(facebook_ads_data_mothlys.impressions) AS impressions_total,SUM(facebook_ads_data_mothlys.reach) AS reach_total,SUM(facebook_ads_data_mothlys.spend) AS spend_total,users.industry_id,industries.name as industriesname,users.marketing_type FROM `facebook_ads_data_mothlys`, `users`, `industries` WHERE facebook_ads_data_mothlys.user_id != '" . auth()->id() . "' AND MONTH(facebook_ads_data_mothlys.date) = MONTH(CURRENT_DATE()) and   users.id = facebook_ads_data_mothlys.user_id and   industries.id = users.industry_id GROUP BY facebook_ads_data_mothlys.user_id ORDER BY  AVG(roas) DESC ");
            }
            $output = '';
            $last_id = '';

            if ($data) {
                $i = 1;
                foreach ($data as $row) {

                    $output .= ' <tr class="ajaxdata" data-id=' . $i . '>
                        <td class="td__tb">
                            <div class="d-flex gap5 align-item-center justify-content-center">
                              ' . $i . '
                            </div>
                        </td>
                        <td class="td__tb">' . $row->industriesname . '</td>
                        <td class="td__tb"> ' . $row->impressions_total . '</td>
                          <td class="td__tb">$ ' . $row->reach_total . '</td>
                        <td class="td__tb "> $ ' . $row->spend_total . '</td>
                            <td class="td__tb ">' . number_format($row->roas, 3, ".", "") . ' X</td>
                        <td class="td__tb">
                            <div class="tag__green">
                            ' . $row->marketing_type . '
                            </div>
                        </td>
                    </tr>';
                    $last_id = $row->id;
                    $i++;
                }
            }

            echo $output;
        }
    }
}
