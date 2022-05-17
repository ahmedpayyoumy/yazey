<?php
namespace App\Services\FacebookAds;

use App\Services\CRUDService;
use App\Services\CurlService;
use App\FacebookAdCreative;
use App\FacebookAdsSet;
use App\FacebookAd;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Log;

class FacebookAdCreativeService extends CRUDService
{
    private $curlService = null;

    public function __construct(
        CurlService $curlService
    ) {
        parent::__construct(FacebookAdCreative::class);
        $this->curlService = $curlService;
    }

    public function saveAdCreative($adCreative, FacebookAdsSet $adsSet, $adAccountId)
    {
        $result = $this->updateOrCreate([
            'creative_id' => $adCreative->id,
            'ad_account_id' => $adAccountId,
            'social_id' => $adsSet->social_id,
            'company_id' => $adsSet->company_id
        ], [
            'creative_id' => $adCreative->id,
            'ad_account_id' => $adAccountId,
            'social_id' => $adsSet->social_id,
            'company_id' => $adsSet->company_id,
            'name' => $adCreative->name,
            'object_story_spec' => $adCreative->object_story_spec
        ]);
        return $result;
    }

    private function buildCreativeUpdateParams(FacebookAds $ads, $data) {
        return [
            'name' => $data['creative_name'],
            'object_story_spec' => [
                'link_data' => [
                    'link' => 'https://fb.com/messenger_doc/',
                    'message' => $data['object_spec_message'],
                    'name' => $data['object_spec_name'],
                    'description' => $data['object_spec_description'],
                    'call_to_action' => [
                        'type' => $data['object_spec_cta'],
                        'value' => [
                            'app_destination' => 'MESSENGER'
                        ]
                    ]
                ]
            ]
        ];
    }

    public function updateAdCreative(FacebookAd $ads, $data)
    {
        try {
            $account = $ads->social_account;
            if ($account) {
                $params = $this->buildCreativeUpdateParams($ads, $data);
                $fbAds = $this->fb->post(
                    '/' . $ads->ad_id,
                    $params,
                    $account->access_token
                );
                return $fbAds->getGraphNode();
            }
        } catch (FacebookResponseException $e) {
            return ['error' => $e->getResponseData()];
        } catch (FacebookSDKException $e) {
            return ['error' => $e->getResponseData()];
        }
    }
}
