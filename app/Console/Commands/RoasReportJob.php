<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ROAS\RoasReportService;

class RoasReportJob extends Command
{
    private $roasReportService = null;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:roas-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate roas report';

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
        RoasReportService $roasReportService
    ) {
        try {
            $this->roasReportService = $roasReportService;
            $this->roasReportService->generateReport();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
