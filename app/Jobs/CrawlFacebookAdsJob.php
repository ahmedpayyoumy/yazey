<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\FacebookAds\FacebookAdsService;
use App\FacebookAdsSet;

class CrawlFacebookAdsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 3;
    private $adsSet;
    private $accessToken;
    private $fbAdsService;

    public function __construct(FacebookAdsSet $adsSet, $accessToken)
    {
        //
        $this->adsSet = $adsSet;
        $this->accessToken = $accessToken;
    }

    public function crawlAds() {
        try {
            $this->fbAdsService->getAllAds($this->adsSet, $this->accessToken, false);
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
        FacebookAdsService $fbAdsService
    )
    {
        //
        try {
            $this->fbAdsService = $fbAdsService;
            if ($this->adsSet) {
                $this->crawlAds();
            }
        } catch (\Exception $e) {

        }

    }
}
