<?php
namespace App\Services\FacebookAds;

use App\FacebookAdsSet;
use App\Services\CurlService;
use Log;

class FacebookAdsTargetService
{
    public function __construct(
        CurlService $curlService
    ) {
        $this->curlService = $curlService;
    }

    private function searchByCountries($searchPhrase, $accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/search?type=adgeolocation&location_types=["country"]&q='.$searchPhrase.'&access_token='.$accessToken;
        $data = $this->curlService->sendGetRequestApi($url);
        $data = json_decode($data);
        foreach ($data->data as &$d) {
            $d->id = '{"type":"countries","name":"'.$d->key.'"}';
            $d->type = 'countries';
            $d->show_type = true;
            $d->text = $d->name;
            $d->description = $d->name;
        }
        return $data->data;
    }

    private function searchByRegions($searchPhrase, $accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/search?type=adgeolocation&location_types=["region"]&q='.$searchPhrase.'&access_token='.$accessToken;
        $data = $this->curlService->sendGetRequestApi($url);
        $data = json_decode($data);
        foreach ($data->data as &$d) {
            $d->id = '{"type":"regions","key":"'.$d->key.'","name":"'.$d->name.'","country":"'.$d->country_name.'"}';
            $d->type = 'regions';
            $d->show_type = true;
            $d->text = $d->name;
            $d->description = $d->name . ', ' . $d->country_name;
        }
        return $data->data;
    }

    private function searchByCities($searchPhrase, $accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/search?type=adgeolocation&location_types=["city"]&q='.$searchPhrase.'&access_token='.$accessToken;
        $data = $this->curlService->sendGetRequestApi($url);
        $data = json_decode($data);
        foreach ($data->data as &$d) {
            $d->id = '{"type":"cities","key":"'.$d->key.'","name":"'.$d->name.'","country":"'.$d->country_name.'","region":"'.$d->region.'","region_id":"'.$d->region_id.'","radius":25,"distance_unit":"mile"}';
            $d->type = 'cities';
            $d->show_type = true;
            $d->text = $d->name;
            $d->description = $d->name .', ' . $d->region . ', ' . $d->country_name;
        }
        return $data->data;
    }

    private function searchByZips($searchPhrase, $accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/search?type=adgeolocation&location_types=["zip"]&q='.$searchPhrase.'&access_token='.$accessToken;
        $data = $this->curlService->sendGetRequestApi($url);
        $data = json_decode($data);
        foreach ($data->data as &$d) {
            $d->id = '{"type":"zips","key":"'.$d->key.'","name":"'.$d->name.'","primary_city_id":'.$d->primary_city_id.',"region_id":'.$d->region_id.',"country":"'.$d->country_name.'"}';
            $d->type = 'zips';
            $d->show_type = true;
            $d->text = $d->name;
            $d->description = $d->name .', ' . $d->primary_city . ', ' . $d->region . ', ' . $d->country_name;
        }
        return $data->data;
    }

    private function searchLocations($searchPhrase, $accessToken)
    {
        $countries = $this->searchByCountries($searchPhrase, $accessToken);
        $regions = $this->searchByRegions($searchPhrase, $accessToken);
        $cities = $this->searchByCities($searchPhrase, $accessToken);
        $zips = $this->searchByZips($searchPhrase, $accessToken);
        return array_merge($countries, $regions, $cities, $zips);
    }

    private function searchInterests($searchPhrase, $accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/search?type=adinterest&location_types=["city"]&q='.$searchPhrase.'&access_token='.$accessToken;
        $data = $this->curlService->sendGetRequestApi($url);
        $data = json_decode($data);
        foreach ($data->data as &$d) {
            $d->id = '{"id":"'.$d->id.'","name":"'.$d->name.'"}';
            $d->text = $d->name;
            $path = implode(' > ', $d->path);
            $d->description = $path . ' ('.number_format($d->audience_size).' audiences)';
        }
        return $data->data;
    }

    public function searchBehaviors($searchPhrase, $accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/search?type=adTargetingCategory&class=behaviors&access_token='.$accessToken;
        $data = $this->curlService->sendGetRequestApi($url);
        $data = json_decode($data);
        $result = [];
        foreach ($data->data as $key => &$d) {
            if (strpos($d->name, $searchPhrase) !== false) {
                $d->id = '{"id":"'.$d->id.'","name":"'.$d->name.'"}';
                $d->text = $d->name;
                $d->description = $d->description . ' ('.number_format($d->audience_size).' audiences)';
                $result []= $d;
            }
        }
        return $result;
    }

    public function searchDemographics($searchPhrase, $accessToken)
    {
        $url = 'https://graph.facebook.com/'.config('facebook.app_version').'/search?type=adTargetingCategory&class=demographics&access_token='.$accessToken;
        $data = $this->curlService->sendGetRequestApi($url);
        $data = json_decode($data);
        $result = [];
        foreach ($data->data as $key => &$d) {
            if (strpos($d->name, $searchPhrase) !== false) {
                $d->id = '{"id":"'.$d->id.'","name":"'.$d->name.'","type":"'.$d->type.'"}';
                $d->text = $d->name;
                $d->description = $d->description . ' ('.number_format($d->audience_size).' audiences)';
                $result []= $d;
            }
        }
        return $result;
    }

    public function search($request, $accessToken)
    {
        switch ($request->type) {
            case 'locations':
                return $this->searchLocations($request->q, $accessToken);
                break;
            case 'interests':
                return $this->searchInterests($request->q, $accessToken);
                break;
            case 'behaviors':
                return $this->searchBehaviors($request->q, $accessToken);
                break;
            case 'demographics':
                return $this->searchDemographics($request->q, $accessToken);
                break;
            default:
                break;
        }
    }

    private function buildTargetLocations($data, $field = 'location_search_include')
    {
        $geoLocation = null;
        if (isset($data[$field])) {
            $locationInclude = json_decode($data[$field]);
            switch ($locationInclude->type) {
                case 'countries':
                    $geoLocation = [
                        'countries' => [$locationInclude->name]
                    ];
                    break;
                case 'regions':
                    $geoLocation = [
                        'regions' => array([
                            'key' => $locationInclude->key,
                            // 'name' => $locationInclude->name,
                            // 'country' => $locationInclude->country
                        ])
                    ];
                    break;
                case 'cities':
                    $geoLocation = [
                        'cities' => array([
                            'key' => $locationInclude->key,
                            // 'name' => $locationInclude->name,
                            // 'country' => $locationInclude->country,
                            // 'region' => $locationInclude->region,
                            // 'region_id' => $locationInclude->region_id,
                            'radius' => $locationInclude->radius,
                            'distance_unit' => $locationInclude->distance_unit
                        ])
                    ];
                    break;
                case 'zips':
                    $geoLocation = [
                        'zips' => array([
                            'key' => $locationInclude->key,
                            // 'name' => $locationInclude->name,
                            // 'primary_city_id' => $locationInclude->primary_city_id,
                            // 'region_id' => $locationInclude->region_id,
                            // 'country' => $locationInclude->country
                        ])
                    ];
                    break;
            }
            // $geoLocation['location_types'] = [
            //     'home',
            //     'recent'
            // ];
        }
        return $geoLocation;
    }

    private function buildTargetInterest($data, $field = 'interests_search_include')
    {
        if (isset($data[$field])) {
            $result = [];
            $interestIncludes = $data[$field];
            foreach ($interestIncludes as $interest) {
                $d = json_decode($interest);
                $result []= $d->id;
            }
            return $result;
        }
        return null;
    }

    private function buildTargetBehavior($data, $field = 'behaviors_search_include')
    {
        if (isset($data[$field])) {
            $result = [];
            $behaviorIncludes = $data[$field];
            foreach ($behaviorIncludes as $behavior) {
                $d = json_decode($behavior);
                $result []= $d->id;
            }
            return $result;
        }
        return null;
    }

    public function buildTargetDemographics($data, $field = 'demographics_search_include')
    {
        if (isset($data[$field])) {
            $result = [];
            $demographicIncludes = $data[$field];
            foreach ($demographicIncludes as $demographic) {
                $d = json_decode($demographic);
                if (isset($result[$d->type])) {
                    $result[$d->type] = [
                        [
                            $d->id
                            // 'id' => $d->id,
                            // 'name' => $d->name
                        ]
                    ];
                } else {
                    $result = [
                        ($d->type) => [
                            $d->id
                            // 'id' => $d->id,
                            // 'name' => $d->name
                        ]
                    ];
                }
            }
            return $result;
        }
        return null;
    }

    public function buildTargettingParams($data)
    {
        $params = [
            'publisher_platforms' => isset($data['publisher_platforms']) ? $data['publisher_platforms'] : [],
            'facebook_positions' => isset($data['facebook_positions']) ? $data['facebook_positions'] : [],
            'instagram_positions' => isset($data['instagram_positions']) ? $data['instagram_positions'] : [],
            'audience_network_positions' => isset($data['audience_network_positions']) ? $data['audience_network_positions'] : [],
            'messenger_positions' => isset($data['messenger_positions']) ? $data['messenger_positions'] : [],
            'device_platforms' => isset($data['device_platforms']) ? $data['device_platforms'] : [],
            'genders' => [(int)$data['gender']],
            'age_min' => (int)$data['age_min'],
            'age_max' => (int)$data['age_max']
        ];
        $geoLocation = $this->buildTargetLocations($data);
        $geoLocationEx = $this->buildTargetLocations($data, 'location_search_exclude');
        $interest = $this->buildTargetInterest($data);
        $interestAlso = $this->buildTargetInterest($data, 'interests_search_also_include');
        $interestEx = $this->buildTargetInterest($data, 'interests_search_exclude');
        $behavior = $this->buildTargetBehavior($data);
        $behaviorAlso = $this->buildTargetBehavior($data, 'behaviors_search_also_include');
        $behaviorEx = $this->buildTargetBehavior($data, 'behaviors_search_exclude');
        $demographic = $this->buildTargetDemographics($data);
        $demographicAlso = $this->buildTargetDemographics($data, 'demographics_search_also_include');
        $demographicEx = $this->buildTargetDemographics($data, 'demographics_search_exclude');

        $flexibleSpec = [
            'interests' => $interest,
            'behaviors' => $behavior,
        ];
        // if (is_object($demographic) || is_array($demographic)) {
        //     foreach ($demographic as $key => $d) {
        //         $flexibleSpec[$key] = $d;
        //     }
        // }

        $flexibleSpecAlso = [
            'interests' => $interestAlso,
            'behaviors' => $behaviorAlso,
        ];
        if (is_object($demographicAlso) || is_array($demographicAlso)) {
            foreach ($demographicAlso as $key => $d) {
                $flexibleSpecAlso[$key] = $d;
            }
        }

        $exclusion = [
            'interests' => $interestEx,
            'behaviors' => $behaviorEx,
        ];
        if (is_object($demographicEx) || is_array($demographicEx)) {
            foreach ($demographicEx as $key => $d) {
                $exclusion[$key] = $d;
            }
        }
        $params = array_merge($params, [
            'geo_locations' => $geoLocation,
            'excluded_geo_locations' => $geoLocationEx,
            'flexible_spec' => [
                (object)$flexibleSpec,
                // (object)$flexibleSpecAlso
            ],
            'exclusions' => (object)$exclusion
        ]);
        return $params;
    }
}
