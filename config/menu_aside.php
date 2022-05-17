<?php
// Aside menu
return [

    'items' => [
        [
            'title' => 'Yazey Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Chart-bar3.svg',
            'page' => '/dashboard',
            'new-tab' => false,
        ],
         [
            'title' => 'Connect Data',
            'root' => true,
            'icon' =>'media/svg/icons/General/Settings-1.svg',
            'page' => 'connect-data',
            'new-tab' => false,
            'sub_pages' => ['connect-data']
        ],
         [
            'title' => 'Agency Spy',
            'root' => true,
            'icon' => 'media/svg/icons/General/AGENCY.svg',
            'page' => 'agency-spy',
            'new-tab' => false,
            'sub_pages' => ['agency-spy']
        ],
         [
            'title' => 'My Profile',
            'root' => true,
            'icon' => 'media/svg/icons/General/User.svg',
            'page' => '/my-profile',
            'new-tab' => false,
        ],
        //  [
        //     'title' => 'Users',
        //     'root' => true,
        //     'icon' => 'media/svg/icons/General/User.svg',
        //     'page' => '/users',
        //     'new-tab' => false,
        // ],
        // [
        //     'title' => 'Agency Spy',
        //     'root' => true,
        //     'icon' => 'fab fa-google',
        //     'page' => 'google-analytics/accounts',
        //     'new-tab' => false,
        //     'sub_pages' => ['google-analytics/accounts']
        // ],
        // [
        //     'title' => 'Google Analytics',
        //     'root' => true,
        //     'icon' => 'fab fa-google',
        //     'page' => 'google-analytics/accounts',
        //     'new-tab' => false,
        //     'sub_pages' => ['google-analytics/accounts']
        // ],
        // [
        //     'title' => 'Facebook Pages',
        //     'root' => true,
        //     'icon' => 'fab fa-facebook',
        //     'page' => 'facebook-fanpage/list',
        //     'new-tab' => false,
        //     'sub_pages' => ['facebook-fanpage/list']
        // ],
        // [
        //     'title' => 'Facebook Ads',
        //     'root' => true,
        //     'icon' => 'fab fa-facebook',
        //     'page' => 'facebook-ads/accounts',
        //     'new-tab' => false,
        //     'sub_pages' => ['facebook-ads/accounts']
        // ],
        
    ]

];
