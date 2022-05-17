<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\FacebookAds\FacebookAdsCampaignService;
use App\FacebookAdsSocialAccount;

class CrawlFacebookAdsCampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 3;
    private $account;
    private $fbAdsCampaignService;

    public function __construct(FacebookAdsSocialAccount $account)
    {
        //
        $this->account = $account;
    }

    public function crawlCampaign() {
        try {
            // $campaigns = $this->account->campaigns;
            // if (count($campaigns) == 0) {
                $this->fbAdsCampaignService->getAllCampaigns($this->account, false);
            // }
        } catch (\Exception $e) {
            dd($e->getFile(), $e->getLine(), $e->getMessage());
        }

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        FacebookAdsCampaignService $fbAdsCampaignService
    )
    {
        //
        try {
            $this->fbAdsCampaignService = $fbAdsCampaignService;
            if ($this->account) {
                $this->crawlCampaign();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
