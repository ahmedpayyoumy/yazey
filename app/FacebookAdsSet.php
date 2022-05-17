<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAdsSet extends Model
{
    //
    protected $fillable = [
        'ad_set_id',
        'name',
        'daily_budget',
        'lifetime_budget',
        'bid_amount',
        'bid_strategy',
        'billing_events',
        'optimization_goal',
        'status',
        'targeting',
        'promoted_object',
        'created_time',
        'start_time',
        'destination_type',
        'spend',
        'page_id',
        'campaign_id',
        'social_id',
        'user_id'
    ];

    protected $casts = [
        'targeting' => 'array',
        'promoted_object' => 'array'
    ];

    const STRATEGY_LOWEST_COST_WITHOUT_CAP = 'LOWEST_COST_WITHOUT_CAP';
    const STRATEGY_LOWEST_COST_WITH_BID_CAP = 'LOWEST_COST_WITH_BID_CAP';
    const STRATEGY_COST_CAP = 'COST_CAP';

    const STRATEGIES = [
        self::STRATEGY_LOWEST_COST_WITHOUT_CAP,
        self::STRATEGY_LOWEST_COST_WITH_BID_CAP,
        self::STRATEGY_COST_CAP
    ];

    const EVENT_APP_INSTALLS = 'APP_INSTALLS';
    const EVENT_IMPRESSIONS = 'IMPRESSIONS';
    const EVENT_LINK_CLICKS = 'LINK_CLICKS';
    const EVENT_NONE = 'NONE';
    const EVENT_OFFER_CLAIMS = 'OFFER_CLAIMS';
    const EVENT_PAGE_LIKES = 'PAGE_LIKES';
    const EVENT_POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const EVENT_THRUPLAY = 'THRUPLAY';
    const EVENT_PURCHASE = 'PURCHASE';
    const EVENT_LISTING_INTERACTION = 'LISTING_INTERACTION';

    const EVENTS = [
        self::EVENT_APP_INSTALLS,
        self::EVENT_IMPRESSIONS,
        self::EVENT_LINK_CLICKS,
        self::EVENT_NONE,
        self::EVENT_OFFER_CLAIMS,
        self::EVENT_PAGE_LIKES,
        self::EVENT_POST_ENGAGEMENT,
        self::EVENT_THRUPLAY,
        self::EVENT_PURCHASE,
        self::EVENT_LISTING_INTERACTION
    ];

    const GOAL_NONE = 'NONE';
    const GOAL_APP_INSTALLS = 'APP_INSTALLS';
    const GOAL_BRAND_AWARENESS = 'BRAND_AWARENESS';
    const GOAL_AD_RECALL_LIFT = 'AD_RECALL_LIFT';
    const GOAL_CLICKS = 'CLICKS';
    const GOAL_ENGAGED_USERS = 'ENGAGED_USERS';
    const GOAL_EVENT_RESPONSES = 'EVENT_RESPONSES';
    const GOAL_IMPRESSIONS = 'IMPRESSIONS';
    const GOAL_LEAD_GENERATION = 'LEAD_GENERATION';
    const GOAL_QUALITY_LEAD = 'QUALITY_LEAD';
    const GOAL_LINK_CLICKS = 'LINK_CLICKS';
    const GOAL_OFFER_CLAIMS = 'OFFER_CLAIMS';
    const GOAL_OFFSITE_CONVERSIONS = 'OFFSITE_CONVERSIONS';
    const GOAL_PAGE_ENGAGEMENT = 'PAGE_ENGAGEMENT';
    const GOAL_PAGE_LIKES = 'PAGE_LIKES';
    const GOAL_POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const GOAL_QUALITY_CALL = 'QUALITY_CALL';
    const GOAL_REACH = 'REACH';
    const GOAL_SOCIAL_IMPRESSIONS = 'SOCIAL_IMPRESSIONS';
    const GOAL_APP_DOWNLOADS = 'APP_DOWNLOADS';
    const GOAL_TWO_SECOND_CONTINUOUS_VIDEO_VIEWS = 'TWO_SECOND_CONTINUOUS_VIDEO_VIEWS';
    const GOAL_LANDING_PAGE_VIEWS = 'LANDING_PAGE_VIEWS';
    const GOAL_VISIT_INSTAGRAM_PROFILE = 'VISIT_INSTAGRAM_PROFILE';
    const GOAL_VALUE = 'VALUE';
    const GOAL_THRUPLAY = 'THRUPLAY';
    const GOAL_REPLIES = 'REPLIES';
    const GOAL_DERIVED_EVENTS = 'DERIVED_EVENTS';
    const GOAL_CONVERSATIONS = 'CONVERSATIONS';

    const GOALS = [
        self::GOAL_NONE,
        self::GOAL_APP_INSTALLS,
        self::GOAL_BRAND_AWARENESS,
        self::GOAL_AD_RECALL_LIFT,
        self::GOAL_CLICKS,
        self::GOAL_ENGAGED_USERS,
        self::GOAL_EVENT_RESPONSES,
        self::GOAL_IMPRESSIONS,
        self::GOAL_LEAD_GENERATION,
        self::GOAL_QUALITY_LEAD,
        self::GOAL_LINK_CLICKS,
        self::GOAL_OFFER_CLAIMS,
        self::GOAL_OFFSITE_CONVERSIONS,
        self::GOAL_PAGE_ENGAGEMENT,
        self::GOAL_PAGE_LIKES,
        self::GOAL_POST_ENGAGEMENT,
        self::GOAL_QUALITY_CALL,
        self::GOAL_REACH,
        self::GOAL_SOCIAL_IMPRESSIONS,
        self::GOAL_APP_DOWNLOADS,
        self::GOAL_TWO_SECOND_CONTINUOUS_VIDEO_VIEWS,
        self::GOAL_LANDING_PAGE_VIEWS,
        self::GOAL_VISIT_INSTAGRAM_PROFILE,
        self::GOAL_VALUE,
        self::GOAL_THRUPLAY,
        self::GOAL_REPLIES,
        self::GOAL_DERIVED_EVENTS,
        self::GOAL_CONVERSATIONS
    ];

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_PAUSED = 'PAUSED';
    const STATUS_DELETED = 'DELETED';
    const STATUS_ARCHIVED = 'ARCHIVED';

    const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_PAUSED,
        self::STATUS_DELETED,
        self::STATUS_ARCHIVED
    ];

    const TARGET_DEMOGRAPHICS = [
        'life_events' => 'Life Events',
        'industries' => 'Industries',
        'income' => 'Income',
        'family_statuses' => 'Family Statuses',
        'user_device' => 'User Device'
    ];

    const PLACEMENT_FEEDS = [
        'name' => 'Feeds',
        'description' => 'Get high visibility for your business with ads in feeds',
        'items' => [
            [
                'name' => 'Facebook News Feed',
                'key' => 'feed',
                'type' => 'facebook_positions'
            ],
            [
                'name' => 'Instagram Feed',
                'key' => 'stream',
                'type' => 'instagram_positions'
            ],
            [
                'name' => 'Facebook Marketplace',
                'key' => 'marketplace',
                'type' => 'facebook_positions'
            ],
            [
                'name' => 'Facebook Video Feeds',
                'key' => 'video_feeds',
                'type' => 'facebook_positions'
            ],
            [
                'name' => 'Facebook Right Column',
                'key' => 'right_hand_column',
                'type' => 'facebook_positions'
            ],
            [
                'name' => 'Instagram Explore',
                'key' => 'explore',
                'type' => 'instagram_positions'
            ],
            [
                'name' => 'Messenger Inbox',
                'key' => 'messenger_home',
                'type' => 'messenger_positions'
            ],
            [
                'name' => 'Facebook Group Feed',
                'key' => 'group_feed',
                'type' => 'facebook_positions',
                'default_disabled' => true
            ]
        ]
    ];

    const PLACEMENT_STORIES_AND_REELS = [
        'name' => 'Stories and Reels',
        'description' => 'Tell a rich, visual story with immersive, fullscreen vertical ads',
        'items' => [
            [
                'name' => 'Instagram Stories',
                'key' => 'story',
                'type' => 'instagram_positions'
            ],
            [
                'name' => 'Facebook Stories',
                'key' => 'story',
                'type' => 'facebook_positions'
            ],
            [
                'name' => 'Messenger Stories',
                'key' => 'story',
                'type' => 'messenger_positions'
            ],
            [
                'name' => 'Instagram Stories',
                'key' => 'story',
                'type' => 'instagram_positions'
            ],
            [
                'name' => 'Instagram Reels',
                'key' => 'reels',
                'type' => 'instagram_positions',
                'default_disabled' => true
            ],
        ]

    ];

    const PLACEMENT_IN_STREAM = [
        'name' => 'In-Stream',
        'description' => 'Quickly capture people\'s attention while they\'re watching videos',
        'items' => [
            [
                'name' => 'Facebook In-Stream Videos',
                'key' => 'instream_video',
                'type' => 'facebook_positions'
            ],
            [
                'name' => 'Instagram IGTV',
                'key' => 'igtv',
                'type' => 'instagram_positions',
                'default_disabled' => true
            ],
        ]
    ];

    const PLACEMENT_SEARCH = [
        'name' => 'Search',
        'description' => 'Get visibility for your business as people search on Facebook',
        'items' => [
            [
                'name' => 'Facebook Search Results',
                'key' => 'search',
                'type' => 'facebook_positions'
            ]
        ]
    ];

    const PLACEMENT_MESSAGES = [
        'name' => 'Messages',
        'description' => 'Send offers or updates to people who are already connected to your business',
        'items' => [
            [
                'name' => 'Messenger Sponsored Messages',
                'key' => 'sponsored_messages',
                'type' => 'messenger_positions'
            ]
        ]
    ];

    const PLACEMENT_IN_ARTICLE = [
        'name' => 'In-Article',
        'description' => 'Engage with people reading content from publishers',
        'items' => [
            [
                'name' => 'Facebook Instant Articles',
                'key' => 'instant_article',
                'type' => 'facebook_positions'
            ]
        ]
    ];

    const PLACEMENT_APPS_AND_SITES = [
        'name' => 'Apps and sites',
        'description' => 'Expand your reach with ads in external apps and websites',
        'items' => [
            [
                'name' => 'Audience Network Native, Banner and Interstitial',
                'key' => 'classic',
                'type' => 'audience_network_positions'
            ],
            [
                'name' => 'Audience Network Rewarded Videos',
                'key' => 'rewarded_video',
                'type' => 'audience_network_positions'
            ],
            [
                'name' => 'Audience Network In-Stream Videos',
                'key' => 'instream_video',
                'type' => 'audience_network_positions'
            ],
        ]
    ];

    const PLACEMENTS = [
        self::PLACEMENT_FEEDS,
        self::PLACEMENT_STORIES_AND_REELS,
        self::PLACEMENT_IN_STREAM,
        self::PLACEMENT_SEARCH,
        self::PLACEMENT_MESSAGES,
        self::PLACEMENT_IN_ARTICLE,
        self::PLACEMENT_APPS_AND_SITES
    ];

    const MESSAGING_WEBSITE = 'WEBSITE';
    const MESSAGING_APP = 'APP';
    const MESSAGING_MESSENGER = 'MESSENGER';
    const MESSAGING_INSTAGRAM = 'INSTAGRAM_DIRECT';
    const MESSAGING_APPS = [
        self::MESSAGING_WEBSITE => 'Website',
        self::MESSAGING_APP => 'App',
        self::MESSAGING_MESSENGER => 'Messenger',
        self::MESSAGING_INSTAGRAM => 'Instagram Direct'
    ];

    public function ad_campaign()
    {
        return $this->belongsTo(FacebookAdsCampaign::class, 'campaign_id', 'id');
    }

    public function social_account()
    {
        return $this->belongsTo(SocialAccount::class, 'social_id', 'id');
    }

    // public function ads()
    // {
    //     return $this->hasMany(FacebookAd::class, 'ad_set_id', 'id');
    // }
}
