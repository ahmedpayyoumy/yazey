<?php

use Illuminate\Database\Seeder;
use App\Services\DataSource\DataSourceService;

class DataSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $connectorService = new DataSourceService();
        $connectors = [
            ['name' => 'Facebook Messenger'],
            ['name' => 'Instagram'],
            ['name' => 'Zalo'],
            ['name' => 'Facebook Ads'],
            ['name' => 'Google Ads'],
            ['name' => 'Gmail'],
            ['name' => 'Mobile App'],
            ['name' => 'Google My Business'],
            ['name' => 'Google Analytics'],
            ['name' => 'QR Code'],
            ['name' => 'Smart Wifi'],
            ['name' => 'Custom API'],
            ['name' => 'Website'],
            ['name' => 'Segment'],
        ];
        foreach ($connectors as $connector) {
            $connectorService->create($connector);
        }
    }
}
