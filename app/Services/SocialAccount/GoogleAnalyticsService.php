<?php

namespace App\Services\SocialAccount;

use App\Services\SocialAccount\SocialAccountService;
use App\SocialAccount;
use App\DataSource;
// use ESP\QRCode\Helpers\QRCodeHelper;
use Google_Client;
use Google_Service_Analytics;
use Carbon\Carbon;

class GoogleAnalyticsService extends SocialAccountService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getClient()
    {
        $client = new Google_Client();
        $client->setAuthConfig([
            'client_id' => config('googleanalytics.app_id'),
            'client_secret' => config('googleanalytics.app_secret'),
            'redirect_uris' => [
                env('APP_URL') . 'google-analytics/callback'
            ],
        ]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        return $client;
    }

    public function getAuthUrl($client)
    {
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
        $client->addScope(Google_Service_Analytics::ANALYTICS_EDIT);
        return $client->createAuthUrl();
    }

    public function listAccounts($conditions = [])
    {
        return $this->listBySource(DataSource::GOOGLE_ANALYTICS, $conditions);
    }

    public function getAccountSummaries($client)
    {
        $analytics = new Google_Service_Analytics($client);
        return $analytics->management_accountSummaries
            ->listManagementAccountSummaries();
    }

    public function getListWebsiteUrl($client)
    {
        $analytics = new Google_Service_Analytics($client);
        $account = $analytics->management_accountSummaries
            ->listManagementAccountSummaries();
        $count = 1;
        $websiteUrls = [];
        $items = $account['items'];
        if (isset($items) && (is_array($items) || is_object($items))) {
            foreach ($items as $item) {
                $properties = $analytics->management_webproperties->listManagementWebproperties($item['id']);

                foreach ($properties['items'] as $property) {
                    $views = $analytics->management_profiles->listManagementProfiles($item['id'], $property['id']);

                    if (empty($views[0])) {
                        continue;
                    }
                    $websiteUrls[] = [
                        'id' => $count++,
                        'view_id' => $views[0]['id'],
                        'website_url' => $views[0]['websiteUrl']
                    ];
                }
            }
        }

        return $websiteUrls;
    }

    public function getAnalyticsResult($client)
    {
        $analytics = new Google_Service_Analytics($client);

        $accounts = $analytics->management_accountSummaries
            ->listManagementAccountSummaries();
        $items = [];
        if (is_array($accounts['items']) || is_object($accounts['items'])) {
            if (count($accounts['items']) > 1) {
                $items[] = $accounts['items'][count($accounts['items']) - 1];
            } else {
                $items = $accounts['items'];
            }
        }
        $result = [];
        if (isset($items) && (is_array($items) || is_object($items))) {
            foreach ($items as $account) {
                $properties = $analytics->management_webproperties->listManagementWebproperties($account['id']);

                foreach ($properties['items'] as $property) {
                    $views = $analytics->management_profiles->listManagementProfiles($account['id'], $property['id']);

                    if (empty($views[0])) {
                        continue;
                    }

                    $result[] = [
                        'website_url' => $views[0]['websiteUrl'],
                        'data' => $this->getDataAnalytics($analytics, $views[0]['id'])
                    ];
                }
            }
        }
        return $result;
    }

    private function getActiveUsers($analytics, $gaId)
    {
        $activeVisitors = $analytics->data_realtime->get(
            'ga:' . $gaId,
            'rt:activeVisitors'
        );
        $rows = $activeVisitors->getRows();
        return $rows ? $rows[0][0] : 0;
    }

    private function getVisitorByDate($analytics, $gaId)
    {
        $visitors30 = $analytics->data_ga->get(
            'ga:' . $gaId,
            '30daysAgo',
            'today',
            'ga:users',
            ['dimensions' => 'ga:date']
        );
        $rows = $visitors30->getRows();
        if (is_array($rows) || is_object($rows)) {
            $labels = array_column($rows, 0);
            $values = array_column($rows, 1);
            foreach ($labels as &$label) {
                $label = Carbon::createFromFormat('Ymd', $label)->format('Y-m-d');
            }
            return [
                'label' => $labels,
                'value' => $values
            ];
        }
        return [
            'label' => '',
            'value' => 0
        ];
    }

    private function getVisitorBySource($analytics, $gaId)
    {
        $source = $analytics->data_ga->get(
            'ga:' . $gaId,
            '30daysAgo',
            'today',
            'ga:users',
            ['dimensions' => 'ga:source']
        );
        $rows = $source->getRows();
        if ($rows) {
            foreach ($rows as $row) {
                $labels = array_column($rows, 0);
                $values = array_column($rows, 1);
                $totalValues = array_sum($values);
                foreach ($values as $key => $value) {
                    $values[$key] = (float)number_format(((int)$value / (int)$totalValues) * 100, 3);
                }

                return [
                    'label' => $labels,
                    'value' => $values
                ];
            }
        }
        return [
            'label' => '',
            'value' => 0
        ];
    }

    private function getVisitorByDevice($analytics, $gaId)
    {
        $source = $analytics->data_ga->get(
            'ga:' . $gaId,
            '30daysAgo',
            'today',
            'ga:users',
            ['dimensions' => 'ga:deviceCategory']
        );
        $rows = $source->getRows();
        if ($rows) {
            foreach ($rows as $row) {
                $labels = array_column($rows, 0);
                $values = array_column($rows, 1);
                $totalValues = array_sum($values);
                foreach ($values as $key => $value) {
                    $values[$key] = (float)number_format(((int)$value / (int)$totalValues) * 100, 3);
                }

                return [
                    'label' => $labels,
                    'value' => $values
                ];
            }
        }
    }

    private function getVisitorByLocation($analytics, $gaId)
    {
        $source = $analytics->data_ga->get(
            'ga:' . $gaId,
            '30daysAgo',
            'today',
            'ga:users',
            ['dimensions' => 'ga:country']
        );
        $rows = $source->getRows();
        if ($rows) {
            foreach ($rows as $row) {
                $labels = array_column($rows, 0);
                $values = array_column($rows, 1);
                $totalValues = array_sum($values);
                foreach ($values as $key => $value) {
                    $values[$key] = (float)number_format(((int)$value / (int)$totalValues) * 100, 3);
                }

                return [
                    'label' => $labels,
                    'value' => $values
                ];
            }
        }
    }

    private function getGeneralReport($analytics, $gaId)
    {
        $result = [
            'users' => 0,
            'newUsers' => 0,
            'sessions' => 0,
            'avgSessionDuration' => 0,
            'bounceRate' => 0
        ];
        $general = $analytics->data_ga->get(
            'ga:' . $gaId,
            '30daysAgo',
            'today',
            'ga:users,ga:newUsers,ga:sessions,ga:avgSessionDuration,ga:bounceRate'
        );
        $rows = $general->getRows();
        if ($rows) {
            $result['users'] = $rows[0][0];
            $result['newUsers'] = $rows[0][1];
            $result['sessions'] = $rows[0][2];
            $result['avgSessionDuration'] = $rows[0][3];
            $result['bounceRate'] = $rows[0][4];
        }
        return $result;
    }

    private function getDataAnalytics($analytics, $gaId)
    {
        $result = [
            'active_visitors' => 0,
            'visitors_30' => [],
            'users' => 0,
            'sessions' => 0,
            'avgSessionDuration' => 0,
            'bounceRate' => 0,
            'sources' => []
        ];
        //
        // // TODO: Active visitors
        $result['active_visitors'] = $this->getActiveUsers($analytics, $gaId);
        //
        // // TODO: Visitors in the last 30 days
        $result['visitors_30'] = $this->getVisitorByDate($analytics, $gaId);
        //
        // // TODO: Visitors by source
        $result['sources'] = $this->getVisitorBySource($analytics, $gaId);
        //
        // // TODO: Visitors by devices
        $result['devices'] = $this->getVisitorByDevice($analytics, $gaId);
        //
        // // TODO: Visitors by devices
        $result['countries'] = $this->getVisitorByLocation($analytics, $gaId);
        //
        // // TODO: General report
        $result = array_merge($result, $this->getGeneralReport($analytics, $gaId));
        //

        return $result;
    }

    public function saveGGAnalyticsAccessToken($credentials)
    {
        $account = null;
        try {
            $account = $this->updateOrCreate([
                'social_id' => $credentials['username'],
                'data_source_id' => DataSource::GOOGLE_ANALYTICS,
                'user_id' => auth()->user()->id
            ], [
                'social_id' => $credentials['username'],
                'data_source_id' => DataSource::GOOGLE_ANALYTICS,
                'user_id' => auth()->user()->id,
                'name' => $credentials['username'],
                'access_token' => $credentials['access_token'],
                'note' => 'Cập nhật token thành công'
            ]);
        } catch (\Exception $e) {
            if ($account) {
                $account->note = $e->getMessage();
                $account->save();
            }
        }
    }

    public function deleteAccount($id)
    {
        $account = $this->firstRow([
            'id' => $id,
            'data_source_id' => DataSource::GOOGLE_ANALYTICS
        ]);
        if ($account) {
            // if ($account->qrcode) {
            //     QRCodeHelper::delete($account->qrcode);
            // }
            $account->delete();
        }
    }

    public function getTotalUsers($accountId, $gaId)
    {
        $account = $this->firstRow(['id' => $accountId]);
        $client = $this->getClient();
        $client->refreshToken($account->access_token);
        $analytics = new Google_Service_Analytics($client);
        $visitors30 = $analytics->data_ga->get(
            'ga:' . $gaId,
            '30daysAgo',
            'today',
            'ga:users',
            ['dimensions' => 'ga:date']
        );
        $rows = $visitors30->getRows();
			
        // $report = $analytics->data_ga->get(
        //     'ga:' . $gaId,
        //     '2005-01-01', // the earliest day by Google Analytics
        //     'today',
        //     'ga:users'
        // );
        // $rows = $report->getRows();
        $total = 0;
        foreach ($rows as $row) {
            $total += $row[1];
        }
        return $total;
    }

    public function getTotalPurchases($accountId, $gaId)
    {
        $account = $this->firstRow(['id' => $accountId]);
        $client = $this->getClient();
        $client->refreshToken($account->access_token);
        $analytics = new Google_Service_Analytics($client);
        $report = $analytics->data_ga->get(
            'ga:' . $gaId,
            '2005-01-01', // the earliest day by Google Analytics
            'today',
            'ga:transactionRevenue'
        );
        $rows = $report->getRows();

        return ($rows && count($rows)) ? $rows[0][0] : 0;
    }
}
