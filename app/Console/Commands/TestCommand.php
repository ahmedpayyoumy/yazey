<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SocialAccount;
use App\Services\FacebookAds\FacebookAdsAccountService;
use App\Services\FacebookAds\FacebookAdsCampaignService;
use App\Services\FacebookAds\FacebookAdsSetService;
use App\Services\FacebookAds\FacebookAdsInsightsService;
use Carbon\Carbon;

class TestCommand extends Command
{
    private $fbAdsAccountService = null;
    private $fbAdsCampaignService = null;
    private $fbAdsSetService = null;
    private $fbAdsInsightsService = null;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';
    //test

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        FacebookAdsAccountService $fbAdsAccountService,
        FacebookAdsCampaignService $fbAdsCampaignService,
        FacebookAdsSetService $fbAdsSetService,
        FacebookAdsInsightsService $fbAdsInsightsService
    ) {
        $this->fbAdsAccountService = $fbAdsAccountService;
        $this->fbAdsCampaignService = $fbAdsCampaignService;
        $this->fbAdsSetService = $fbAdsSetService;
        $this->fbAdsInsightsService = $fbAdsInsightsService;
        try {
            $campaign = $this->fbAdsCampaignService->firstRow(['id' => 31]);
            $socialAccount = $campaign->social_account;
            $this->fbAdsSetService->getAllAdsSets($campaign, $socialAccount->access_token);
            // $accounts = $this->fbAdsAccountService->listAccounts();
            // foreach ($accounts as $account) {
            //     dd($this->fbAdsInsightsService->listByYear($account->id));
            //     // for ($month = 12; $month <= 12; $month++) {
            //     //     $date = Carbon::createFromFormat('m-Y', $month . '-2018');
            //     //     $start = $date->copy()->startOfMonth()->format('Y-m-d');
            //     //     $end = $date->copy()->endOfMonth()->format('Y-m-d');
            //     //     $spend = json_decode($this->fbAdsInsightsService->getAccountSpendByDate($account, $start, $end));
            //     //
            //     //     if (isset($spend->data) && count($spend->data)) {
            //     //         $data = $spend->data;
            //     //         $spend = $data[0]->spend;
            //     //         dd($spend);
            //     //     }
            //     // }
            // }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
