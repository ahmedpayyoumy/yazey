<?php
namespace App\Services\ROAS;

use App\Services\CRUDService;
use App\Services\Industry\IndustryService;
use App\Services\SocialAccount\GoogleAnalyticsService;
use App\Services\UserSelectedAccount\UserSelectedAccountService;
use App\RoasReport;
use App\Helpers\Pagination;
use DB;
class RoasReportService extends CRUDService
{
    private $userSelectAccountService = null;
    private $ggAnalyticsService = null;

    public function __construct(
        UserSelectedAccountService $userSelectAccountService,
        GoogleAnalyticsService $ggAnalyticsService
    ) {
        $this->userSelectAccountService = $userSelectAccountService;
        $this->ggAnalyticsService = $ggAnalyticsService;
        parent::__construct(RoasReport::class);
    }

    public function generateReport()
    {
        $userSelectAccounts = $this->userSelectAccountService->list();
        foreach ($userSelectAccounts as $userSelectAccount) {
            $analyticData = $this->ggAnalyticsService->getTotalUsers(
                $userSelectAccount->google_analytics_account_id,
                $userSelectAccount->view_id
            );
            // $adsData = $this->
            $this->updateOrCreate([
                'industry_id' => $userSelectAccount->industry_id,
                'user_selected_account_id' => $userSelectAccount->id
            ], [
                'industry_id' => $userSelectAccount->industry_id,
                'user_selected_account_id' => $userSelectAccount->id,
                'monthly_traffic' => $analyticData
            ]);
        }
    }

    public function getReportWithPagination($page = 1, $conditions = [])
    {
        $report = $this->getModel()
                    ->with([
                        'industry',
                        'user_selected_account'
                    ])->where($conditions);
        $total = $report->count();
        
        $totalPage = (int) ($total / RoasReport::PER_PAGE) + (($total % RoasReport::PER_PAGE) !== 0);
        $previousPage = ($page == 1) ? 1 : ($page - 1);
        $nextPage = ($page === $totalPage) ? $totalPage : ($page + 1);
        $listPages = Pagination::initArray($page, $totalPage);
        $report = $report->orderBy('created_at', 'DESC')
            ->skip(RoasReport::PER_PAGE * ($page - 1))
            ->take(RoasReport::PER_PAGE)
            ->get();
        return [
            'page' => $page,
            'maxPage' => RoasReport::PER_PAGE,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage,
            'totalPage' => $totalPage,
            'listPages' => $listPages,
            'report' => $report
        ];
    }

    public function updateReportByAdsSet($adsSet)
    {
        $pageId = null;
        if ($adsSet->promoted_object && isset($adsSet->promoted_object['page_id'])) {
            $pageId = $adsSet->promoted_object['page_id'];
        } 
       
        $this->userSelectAccountService->updateOrCreate([
            'user_id' => auth()->id()
        ], [
            'user_id' => auth()->id(),
            'industry_id' => auth()->user()->industry->id,
            'facebook_ads_account_id' => $adsSet->social_id,
            'page_id' => $pageId
        ]);
        $userSelectAccount = DB::table('user_selected_accounts')->where('user_id', auth()->id())->first();

        // $userSelectAccount = $this->firstRow(['user_id' => auth()->id()]);
        
        $report = $this->firstRow([
            'industry_id' => $userSelectAccount->industry_id,
            'user_selected_account_id' => $userSelectAccount->id
        ]);
          
        if (!$report) {
            $report = $this->create([
                'industry_id' => $userSelectAccount->industry_id,
                'user_selected_account_id' => $userSelectAccount->id,
                'ads_spent' => $adsSet->spend,
                'user_id'=>auth()->id()
            ]);
     
        } else {
            $all=$report->update([
                'industry_id' => $userSelectAccount->industry_id,
                'user_selected_account_id' => $userSelectAccount->id,
                'ads_spent' => $report->ads_spent + $adsSet->spend,
                'user_id'=>auth()->id()
            ]);
               
        }
    }
}
