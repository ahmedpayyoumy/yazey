<?php

namespace ESP\QRCode;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class QRCodeServiceProvider extends ServiceProvider
{
    // protected $commands = [
    //     'ESP\QRCode\Commands\HubclubGetReportDetail'
    // ];
    public function register()
    {
        if (!defined('ESP_QRCODE')) {
            define('ESP_QRCODE', realpath(__DIR__));
        }
        // $this->commands($this->commands);
    }

    public function boot(Router $router)
    {
        // $this->app['router']->aliasMiddleware('is_hubclub_manager', IsHubclubManager::class);
        $this->loadRoutesFrom(ESP_QRCODE . '/Routes/web.php');
        $this->loadMigrationsFrom(ESP_QRCODE . '/Migrations');
        $this->loadViewsFrom(ESP_QRCODE . '/Resources', 'esp/qrcode');
        $this->publishes([
            ESP_QRCODE . '/Resources' => resource_path('views')
        ], 'qrcode-views');
    }
}
