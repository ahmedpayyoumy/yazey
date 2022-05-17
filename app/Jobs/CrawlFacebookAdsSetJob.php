<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\FacebookAds\FacebookAdsSetService;
use App\FacebookAdsCampaign;

class CrawlFacebookAdsSetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 3;
    private $campaign;
    private $accessToken;
    private $fbAdsSetService;

    public function __construct(FacebookAdsCampaign $campaign, $accessToken)
    {
        //
        $this->campaign = $campaign;
        $this->accessToken = $accessToken;
    }

    public function crawlAdsSet()
    {
        try {
            // $adsSets = $this->campaign->ad_sets;
            // if (count($adsSets) == 0) {
            $this->fbAdsSetService->getAllAdsSets($this->campaign, $this->accessToken, false);
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
        FacebookAdsSetService $fbAdsSetService
    ) {
        //
        try {
            $this->fbAdsSetService = $fbAdsSetService;
            if ($this->campaign) {
                $this->crawlAdsSet();
            }
        } catch (\Exception $e) {
            dd($e->getFile(), $e->getLine(), $e->getMessage());
        }
    }
}
