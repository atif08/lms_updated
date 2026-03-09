<?php

namespace App\Console;

use App\Jobs\AmazonProducts\GetProductCatalogJob;
use App\Jobs\AmazonProducts\GetProductFeesJob;
use App\Jobs\AmazonProducts\GetProductOffersJob;
use App\Jobs\AmazonReports\ProcessReportJob;
use App\Jobs\AmazonReports\RequestReportJob;
use App\Jobs\AmazonShipments\CreateShipmentsHistoryJob;
use App\Jobs\AmazonShipments\GetInboundShipmentsJob;
use App\Jobs\KeepaAPIs\GetProductSearchJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * Register the commands for the application.
     */
    protected function commands(): void {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/commands/console.php');
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void {
    }
}
