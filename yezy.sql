-- -------------------------------------------------------------
-- TablePlus 4.2.0(388)
--
-- https://tableplus.com/
--
-- Database: yezy
-- Generation Time: 2021-11-22 17:53:45.0570
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact_form_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact_forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_reply` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `data_sources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `facebook_ads_campaigns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `objective` enum('APP_INSTALLS','BRAND_AWARENESS','CONVERSIONS','EVENT_RESPONSES','LEAD_GENERATION','LINK_CLICKS','LOCAL_AWARENESS','MESSAGES','OFFER_CLAIMS','PAGE_LIKES','POST_ENGAGEMENT','PRODUCT_CATALOG_SALES','REACH','STORE_VISITS','VIDEO_VIEWS') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `stop_time` datetime DEFAULT NULL,
  `status` enum('ACTIVE','PAUSED','DELETED','ARCHIVED') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_account_id` bigint unsigned DEFAULT NULL,
  `social_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facebook_ads_campaigns_ad_account_id_foreign` (`ad_account_id`),
  KEY `facebook_ads_campaigns_social_id_foreign` (`social_id`),
  KEY `facebook_ads_campaigns_user_id_foreign` (`user_id`),
  CONSTRAINT `facebook_ads_campaigns_ad_account_id_foreign` FOREIGN KEY (`ad_account_id`) REFERENCES `facebook_ads_social_accounts` (`id`),
  CONSTRAINT `facebook_ads_campaigns_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_accounts` (`id`),
  CONSTRAINT `facebook_ads_campaigns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `facebook_ads_insights` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `spend` double NOT NULL DEFAULT '0',
  `ad_account_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `facebook_ads_sets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ad_set_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_budget` int unsigned NOT NULL DEFAULT '0',
  `lifetime_budget` int unsigned NOT NULL DEFAULT '0',
  `bid_amount` int unsigned NOT NULL DEFAULT '0',
  `bid_strategy` enum('LOWEST_COST_WITHOUT_CAP','LOWEST_COST_WITH_BID_CAP','COST_CAP') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_events` enum('APP_INSTALLS','IMPRESSIONS','LINK_CLICKS','NONE','OFFER_CLAIMS','PAGE_LIKES','POST_ENGAGEMENT','THRUPLAY','PURCHASE','LISTING_INTERACTION') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optimization_goal` enum('NONE','APP_INSTALLS','BRAND_AWARENESS','AD_RECALL_LIFT','CLICKS','ENGAGED_USERS','EVENT_RESPONSES','IMPRESSIONS','LEAD_GENERATION','QUALITY_LEAD','LINK_CLICKS','OFFER_CLAIMS','OFFSITE_CONVERSIONS','PAGE_ENGAGEMENT','PAGE_LIKES','POST_ENGAGEMENT','QUALITY_CALL','REACH','SOCIAL_IMPRESSIONS','APP_DOWNLOADS','TWO_SECOND_CONTINUOUS_VIDEO_VIEWS','LANDING_PAGE_VIEWS','VISIT_INSTAGRAM_PROFILE','VALUE','THRUPLAY','REPLIES','DERIVED_EVENTS','CONVERSATIONS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','PAUSED','DELETED','ARCHIVED') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `targeting` json DEFAULT NULL,
  `promoted_object` json DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `campaign_id` bigint unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `social_id` bigint unsigned DEFAULT NULL,
  `spend` double NOT NULL DEFAULT '0',
  `page_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facebook_ads_sets_campaign_id_foreign` (`campaign_id`),
  KEY `facebook_ads_sets_user_id_foreign` (`user_id`),
  KEY `facebook_ads_sets_social_id_foreign` (`social_id`),
  CONSTRAINT `facebook_ads_sets_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `facebook_ads_campaigns` (`id`),
  CONSTRAINT `facebook_ads_sets_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_accounts` (`id`),
  CONSTRAINT `facebook_ads_sets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `facebook_ads_social_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_account_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `spend` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `facebook_ads_social_accounts_social_account_id_foreign` (`social_account_id`),
  CONSTRAINT `facebook_ads_social_accounts_social_account_id_foreign` FOREIGN KEY (`social_account_id`) REFERENCES `social_accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `facebook_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `avatar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `page_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `access_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `social_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facebook_pages_user_id_foreign` (`user_id`),
  KEY `facebook_pages_social_id_foreign` (`social_id`),
  CONSTRAINT `facebook_pages_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_accounts` (`id`),
  CONSTRAINT `facebook_pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `faqs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `question` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `industries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `media_category` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `media_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `post_category` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `post_metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `meta_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `post_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `feature_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('post','page') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `status` enum('published','scheduled','draft') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `scheduled_time` timestamp NULL DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `qr_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roas_reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `monthly_traffic` double NOT NULL DEFAULT '0',
  `ads_spent` double NOT NULL DEFAULT '0',
  `industry_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_selected_account_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roas_reports_industry_id_foreign` (`industry_id`),
  KEY `roas_reports_user_selected_account_id_foreign` (`user_selected_account_id`),
  CONSTRAINT `roas_reports_industry_id_foreign` FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`),
  CONSTRAINT `roas_reports_user_selected_account_id_foreign` FOREIGN KEY (`user_selected_account_id`) REFERENCES `user_selected_accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `schedule_histories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int unsigned NOT NULL,
  `command` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `output` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_histories_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `schedule_histories_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `schedules` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `command` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `command_custom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `params` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `expression` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `log_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `even_in_maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `without_overlapping` tinyint(1) NOT NULL DEFAULT '0',
  `on_one_server` tinyint(1) NOT NULL DEFAULT '0',
  `webhook_before` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webhook_after` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_output` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sendmail_error` tinyint(1) NOT NULL DEFAULT '0',
  `log_success` tinyint(1) NOT NULL DEFAULT '1',
  `log_error` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `run_in_background` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `sendmail_success` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `scripts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `script_header` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `script_footer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `option_compare` enum('exactly','all','contain','not_contain') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `social_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_src` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `social_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data_source_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_accounts_data_source_id_foreign` (`data_source_id`),
  KEY `social_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `social_accounts_data_source_id_foreign` FOREIGN KEY (`data_source_id`) REFERENCES `data_sources` (`id`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_selected_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `view_id` int DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `google_analytics_account_id` bigint unsigned DEFAULT NULL,
  `facebook_ads_account_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `industry_id` bigint unsigned DEFAULT NULL,
  `page_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_selected_accounts_user_id_foreign` (`user_id`),
  KEY `user_selected_accounts_google_analytics_account_id_foreign` (`google_analytics_account_id`),
  KEY `user_selected_accounts_facebook_ads_account_id_foreign` (`facebook_ads_account_id`),
  KEY `user_selected_accounts_industry_id_foreign` (`industry_id`),
  CONSTRAINT `user_selected_accounts_facebook_ads_account_id_foreign` FOREIGN KEY (`facebook_ads_account_id`) REFERENCES `social_accounts` (`id`),
  CONSTRAINT `user_selected_accounts_google_analytics_account_id_foreign` FOREIGN KEY (`google_analytics_account_id`) REFERENCES `social_accounts` (`id`),
  CONSTRAINT `user_selected_accounts_industry_id_foreign` FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`),
  CONSTRAINT `user_selected_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verify` tinyint NOT NULL DEFAULT '0',
  `expired_token_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `industry_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_industry_id_foreign` (`industry_id`),
  CONSTRAINT `users_industry_id_foreign` FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `data_sources` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Facebook Messenger', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(2, 'Instagram', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(3, 'Zalo', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(4, 'Facebook Ads', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(5, 'Google Ads', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(6, 'Gmail', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(7, 'Mobile App', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(8, 'Google My Business', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(9, 'Google Analytics', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(10, 'QR Code', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(11, 'Smart Wifi', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(12, 'Custom API', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(13, 'Website', '2021-11-03 16:14:48', '2021-11-03 16:14:48'),
(14, 'Segment', '2021-11-03 16:14:48', '2021-11-03 16:14:48');

INSERT INTO `facebook_ads_campaigns` (`id`, `campaign_id`, `name`, `objective`, `created_time`, `start_time`, `stop_time`, `status`, `ad_account_id`, `social_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '23848382727080058', 'Sup Bao Ngu', 'MESSAGES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'ACTIVE', 1, 1, '2021-11-03 22:31:18', '2021-11-06 01:29:17', 1),
(2, '23848356853270058', 'CSN', 'MESSAGES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 1, 1, '2021-11-03 22:31:18', '2021-11-06 01:29:17', 1),
(3, '23848052473090040', 'Big sea foood', 'MESSAGES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'ACTIVE', 2, 2, '2021-11-03 22:31:19', '2021-11-06 01:29:22', 1),
(4, '23848022448470040', 'CSN', 'MESSAGES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 2, 2, '2021-11-03 22:31:19', '2021-11-06 01:29:22', 1),
(5, '23848384922660020', 'CSN', 'MESSAGES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 4, 4, '2021-11-03 22:31:20', '2021-11-06 01:29:31', 1),
(9, '23848967839610568', 'Traffic 1', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(10, '23848943934170568', 'Lead Gen Form', 'LEAD_GENERATION', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(11, '23847630082940568', 'Stockholm FB Ads', 'CONVERSIONS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(12, '23847624213780568', 'Retarget – Version B', 'CONVERSIONS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(13, '23847624213770568', 'Retarget – Version A', 'CONVERSIONS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(14, '23847622624650568', 'Retarget', 'CONVERSIONS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(15, '23847608339280568', 'Nordic 50% 48 Hours', 'CONVERSIONS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(16, '23847600096430568', 'iceland 999kr', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(17, '23847590205120568', '[01/04/2021] Promoting http://AshBarbour.com/', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(18, '23847523292600568', '[24/03/2021] Promoting Send Message', 'MESSAGES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(19, '23846717933600568', 'ca nz aus', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(20, '23846717605160568', 'uk', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PAUSED', 10, 14, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(21, '23848624740340581', 'Co-founder', 'POST_ENGAGEMENT', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(22, '23848439131470581', 'Traffic – copy', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(23, '23848433392880581', 'Retarget', 'REACH', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(24, '23848433345780581', 'Retarget new', 'REACH', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(25, '23848415066850581', 'Traffic – Impressions', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(26, '23848415041660581', 'Retarget Conversions – Reach - Impressions', 'REACH', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(27, '23848415034040581', 'Retarget Conversions – Brand awareness', 'BRAND_AWARENESS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(28, '23848409441280581', 'Retarget Conversions', 'CONVERSIONS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(29, '23848409128840581', 'Conversions', 'CONVERSIONS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(30, '23848407563450581', 'Traffic', 'LINK_CLICKS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 11, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(31, '23848639784390604', 'Lamont test', 'MESSAGES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'PAUSED', 8, 8, '2021-11-19 14:34:43', '2021-11-21 14:36:44', 5),
(32, '23848145171790604', 'Testing Message', 'BRAND_AWARENESS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'ACTIVE', 8, 8, '2021-11-20 22:23:15', '2021-11-21 14:36:44', 5),
(33, '23842940255740604', 'Lead generation', 'LEAD_GENERATION', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PAUSED', 8, 8, '2021-11-20 22:23:15', '2021-11-21 14:36:44', 5);

INSERT INTO `facebook_ads_insights` (`id`, `date`, `spend`, `ad_account_id`, `created_at`, `updated_at`) VALUES
(1, '2021-01-01', 0, 1, '2021-11-06 01:29:13', '2021-11-06 01:29:13'),
(2, '2021-02-01', 0, 1, '2021-11-06 01:29:14', '2021-11-06 01:29:14'),
(3, '2021-03-01', 0, 1, '2021-11-06 01:29:14', '2021-11-06 01:29:14'),
(4, '2021-04-01', 0, 1, '2021-11-06 01:29:14', '2021-11-06 01:29:14'),
(5, '2021-05-01', 0, 1, '2021-11-06 01:29:15', '2021-11-06 01:29:15'),
(6, '2021-06-01', 0, 1, '2021-11-06 01:29:15', '2021-11-06 01:29:15'),
(7, '2021-07-01', 2284902, 1, '2021-11-06 01:29:15', '2021-11-06 01:29:15'),
(8, '2021-08-01', 0, 1, '2021-11-06 01:29:16', '2021-11-06 01:29:16'),
(9, '2021-09-01', 0, 1, '2021-11-06 01:29:16', '2021-11-06 01:29:16'),
(10, '2021-10-01', 0, 1, '2021-11-06 01:29:16', '2021-11-06 01:29:16'),
(11, '2021-11-01', 0, 1, '2021-11-06 01:29:17', '2021-11-06 01:29:17'),
(12, '2021-12-01', 0, 1, '2021-11-06 01:29:17', '2021-11-06 01:29:17'),
(13, '2021-01-01', 0, 2, '2021-11-06 01:29:18', '2021-11-06 01:29:18'),
(14, '2021-02-01', 0, 2, '2021-11-06 01:29:19', '2021-11-06 01:29:19'),
(15, '2021-03-01', 0, 2, '2021-11-06 01:29:19', '2021-11-06 01:29:19'),
(16, '2021-04-01', 0, 2, '2021-11-06 01:29:19', '2021-11-06 01:29:19'),
(17, '2021-05-01', 0, 2, '2021-11-06 01:29:20', '2021-11-06 01:29:20'),
(18, '2021-06-01', 0, 2, '2021-11-06 01:29:20', '2021-11-06 01:29:20'),
(19, '2021-07-01', 954.6, 2, '2021-11-06 01:29:20', '2021-11-06 01:29:20'),
(20, '2021-08-01', 0, 2, '2021-11-06 01:29:21', '2021-11-06 01:29:21'),
(21, '2021-09-01', 0, 2, '2021-11-06 01:29:21', '2021-11-06 01:29:21'),
(22, '2021-10-01', 0, 2, '2021-11-06 01:29:21', '2021-11-06 01:29:21'),
(23, '2021-11-01', 0, 2, '2021-11-06 01:29:22', '2021-11-06 01:29:22'),
(24, '2021-12-01', 0, 2, '2021-11-06 01:29:22', '2021-11-06 01:29:22'),
(25, '2021-01-01', 0, 3, '2021-11-06 01:29:23', '2021-11-06 01:29:23'),
(26, '2021-02-01', 0, 3, '2021-11-06 01:29:23', '2021-11-06 01:29:23'),
(27, '2021-03-01', 0, 3, '2021-11-06 01:29:24', '2021-11-06 01:29:24'),
(28, '2021-04-01', 0, 3, '2021-11-06 01:29:24', '2021-11-06 01:29:24'),
(29, '2021-05-01', 0, 3, '2021-11-06 01:29:24', '2021-11-06 01:29:24'),
(30, '2021-06-01', 0, 3, '2021-11-06 01:29:25', '2021-11-06 01:29:25'),
(31, '2021-07-01', 0, 3, '2021-11-06 01:29:25', '2021-11-06 01:29:25'),
(32, '2021-08-01', 0, 3, '2021-11-06 01:29:25', '2021-11-06 01:29:25'),
(33, '2021-09-01', 0, 3, '2021-11-06 01:29:26', '2021-11-06 01:29:26'),
(34, '2021-10-01', 0, 3, '2021-11-06 01:29:26', '2021-11-06 01:29:26'),
(35, '2021-11-01', 0, 3, '2021-11-06 01:29:26', '2021-11-06 01:29:26'),
(36, '2021-12-01', 0, 3, '2021-11-06 01:29:26', '2021-11-06 01:29:26'),
(37, '2021-01-01', 0, 4, '2021-11-06 01:29:28', '2021-11-06 01:29:28'),
(38, '2021-02-01', 0, 4, '2021-11-06 01:29:28', '2021-11-06 01:29:28'),
(39, '2021-03-01', 0, 4, '2021-11-06 01:29:28', '2021-11-06 01:29:28'),
(40, '2021-04-01', 0, 4, '2021-11-06 01:29:29', '2021-11-06 01:29:29'),
(41, '2021-05-01', 0, 4, '2021-11-06 01:29:29', '2021-11-06 01:29:29'),
(42, '2021-06-01', 0, 4, '2021-11-06 01:29:29', '2021-11-06 01:29:29'),
(43, '2021-07-01', 949.29, 4, '2021-11-06 01:29:30', '2021-11-06 01:29:30'),
(44, '2021-08-01', 0, 4, '2021-11-06 01:29:30', '2021-11-06 01:29:30'),
(45, '2021-09-01', 0, 4, '2021-11-06 01:29:30', '2021-11-06 01:29:30'),
(46, '2021-10-01', 0, 4, '2021-11-06 01:29:31', '2021-11-06 01:29:31'),
(47, '2021-11-01', 0, 4, '2021-11-06 01:29:31', '2021-11-06 01:29:31'),
(48, '2021-12-01', 0, 4, '2021-11-06 01:29:31', '2021-11-06 01:29:31'),
(49, '2021-01-01', 0, 5, '2021-11-06 01:29:32', '2021-11-06 01:29:32'),
(50, '2021-02-01', 0, 5, '2021-11-06 01:29:33', '2021-11-06 01:29:33'),
(51, '2021-03-01', 0, 5, '2021-11-06 01:29:33', '2021-11-06 01:29:33'),
(52, '2021-04-01', 0, 5, '2021-11-06 01:29:33', '2021-11-06 01:29:33'),
(53, '2021-05-01', 0, 5, '2021-11-06 01:29:34', '2021-11-06 01:29:34'),
(54, '2021-06-01', 0, 5, '2021-11-06 01:29:34', '2021-11-06 01:29:34'),
(55, '2021-07-01', 0, 5, '2021-11-06 01:29:34', '2021-11-06 01:29:34'),
(56, '2021-08-01', 0, 5, '2021-11-06 01:29:35', '2021-11-06 01:29:35'),
(57, '2021-09-01', 0, 5, '2021-11-06 01:29:35', '2021-11-06 01:29:35'),
(58, '2021-10-01', 0, 5, '2021-11-06 01:29:35', '2021-11-06 01:29:35'),
(59, '2021-11-01', 0, 5, '2021-11-06 01:29:36', '2021-11-06 01:29:36'),
(60, '2021-12-01', 0, 5, '2021-11-06 01:29:36', '2021-11-06 01:29:36'),
(61, '2021-01-01', 0, 6, '2021-11-06 01:29:37', '2021-11-06 01:29:37'),
(62, '2021-02-01', 0, 6, '2021-11-06 01:29:38', '2021-11-06 01:29:38'),
(63, '2021-03-01', 0, 6, '2021-11-06 01:29:38', '2021-11-06 01:29:38'),
(64, '2021-04-01', 0, 6, '2021-11-06 01:29:38', '2021-11-06 01:29:38'),
(65, '2021-05-01', 0, 6, '2021-11-06 01:29:38', '2021-11-06 01:29:38'),
(66, '2021-06-01', 0, 6, '2021-11-06 01:29:39', '2021-11-06 01:29:39'),
(67, '2021-07-01', 0, 6, '2021-11-06 01:29:39', '2021-11-06 01:29:39'),
(68, '2021-08-01', 0, 6, '2021-11-06 01:29:39', '2021-11-06 01:29:39'),
(69, '2021-09-01', 0, 6, '2021-11-06 01:29:40', '2021-11-06 01:29:40'),
(70, '2021-10-01', 0, 6, '2021-11-06 01:29:40', '2021-11-06 01:29:40'),
(71, '2021-11-01', 0, 6, '2021-11-06 01:29:41', '2021-11-06 01:29:41'),
(72, '2021-12-01', 0, 6, '2021-11-06 01:29:41', '2021-11-06 01:29:41'),
(73, '2021-01-01', 0, 14, '2021-11-07 19:08:29', '2021-11-07 19:08:29'),
(74, '2021-02-01', 0, 14, '2021-11-07 19:08:29', '2021-11-07 19:08:29'),
(75, '2021-03-01', 4.71, 14, '2021-11-07 19:08:30', '2021-11-07 19:08:30'),
(76, '2021-04-01', 30.06, 14, '2021-11-07 19:08:30', '2021-11-07 19:08:30'),
(77, '2021-05-01', 0, 14, '2021-11-07 19:08:31', '2021-11-07 19:08:31'),
(78, '2021-06-01', 0, 14, '2021-11-07 19:08:31', '2021-11-07 19:08:31'),
(79, '2021-07-01', 0, 14, '2021-11-07 19:08:32', '2021-11-07 19:08:32'),
(80, '2021-08-01', 30.67, 14, '2021-11-07 19:08:32', '2021-11-07 19:08:32'),
(81, '2021-09-01', 17.48, 14, '2021-11-07 19:08:33', '2021-11-07 19:08:33'),
(82, '2021-10-01', 0, 14, '2021-11-07 19:08:33', '2021-11-07 19:08:33'),
(83, '2021-11-01', 0, 14, '2021-11-07 19:08:34', '2021-11-07 19:08:34'),
(84, '2021-12-01', 0, 14, '2021-11-07 19:08:34', '2021-11-07 19:08:34'),
(85, '2021-01-01', 0, 15, '2021-11-07 19:08:36', '2021-11-07 19:08:36'),
(86, '2021-02-01', 0, 15, '2021-11-07 19:08:36', '2021-11-07 19:08:36'),
(87, '2021-03-01', 0, 15, '2021-11-07 19:08:37', '2021-11-07 19:08:37'),
(88, '2021-04-01', 0, 15, '2021-11-07 19:08:37', '2021-11-07 19:08:37'),
(89, '2021-05-01', 0, 15, '2021-11-07 19:08:38', '2021-11-07 19:08:38'),
(90, '2021-06-01', 0, 15, '2021-11-07 19:08:38', '2021-11-07 19:08:38'),
(91, '2021-07-01', 0, 15, '2021-11-07 19:08:39', '2021-11-07 19:08:39'),
(92, '2021-08-01', 0, 15, '2021-11-07 19:08:39', '2021-11-07 19:08:39'),
(93, '2021-09-01', 65.44, 15, '2021-11-07 19:08:39', '2021-11-07 19:08:39'),
(94, '2021-10-01', 262.38, 15, '2021-11-07 19:08:40', '2021-11-07 19:08:40'),
(95, '2021-11-01', 0, 15, '2021-11-07 19:08:40', '2021-11-07 19:08:40'),
(96, '2021-12-01', 0, 15, '2021-11-07 19:08:41', '2021-11-07 19:08:41'),
(97, '2021-01-01', 0, 16, '2021-11-07 19:08:42', '2021-11-07 19:08:42'),
(98, '2021-02-01', 0, 16, '2021-11-07 19:08:43', '2021-11-07 19:08:43'),
(99, '2021-03-01', 0, 16, '2021-11-07 19:08:43', '2021-11-07 19:08:43'),
(100, '2021-04-01', 0, 16, '2021-11-07 19:08:44', '2021-11-07 19:08:44'),
(101, '2021-05-01', 0, 16, '2021-11-07 19:08:44', '2021-11-07 19:08:44'),
(102, '2021-06-01', 0, 16, '2021-11-07 19:08:45', '2021-11-07 19:08:45'),
(103, '2021-07-01', 0, 16, '2021-11-07 19:08:45', '2021-11-07 19:08:45'),
(104, '2021-08-01', 0, 16, '2021-11-07 19:08:45', '2021-11-07 19:08:45'),
(105, '2021-09-01', 0, 16, '2021-11-07 19:08:46', '2021-11-07 19:08:46'),
(106, '2021-10-01', 0, 16, '2021-11-07 19:08:46', '2021-11-07 19:08:46'),
(107, '2021-11-01', 0, 16, '2021-11-07 19:08:47', '2021-11-07 19:08:47'),
(108, '2021-12-01', 0, 16, '2021-11-07 19:08:47', '2021-11-07 19:08:47'),
(109, '2021-01-01', 0, 8, '2021-11-19 14:34:41', '2021-11-21 14:36:42'),
(110, '2021-02-01', 0, 8, '2021-11-19 14:34:41', '2021-11-21 14:36:42'),
(111, '2021-03-01', 0, 8, '2021-11-19 14:34:41', '2021-11-21 14:36:42'),
(112, '2021-04-01', 0, 8, '2021-11-19 14:34:41', '2021-11-21 14:36:42'),
(113, '2021-05-01', 0, 8, '2021-11-19 14:34:41', '2021-11-21 14:36:43'),
(114, '2021-06-01', 0, 8, '2021-11-19 14:34:42', '2021-11-21 14:36:43'),
(115, '2021-07-01', 0, 8, '2021-11-19 14:34:42', '2021-11-21 14:36:43'),
(116, '2021-08-01', 0, 8, '2021-11-19 14:34:42', '2021-11-21 14:36:43'),
(117, '2021-09-01', 0, 8, '2021-11-19 14:34:42', '2021-11-21 14:36:43'),
(118, '2021-10-01', 0, 8, '2021-11-19 14:34:42', '2021-11-21 14:36:44'),
(119, '2021-11-01', 0, 8, '2021-11-19 14:34:42', '2021-11-21 14:36:44'),
(120, '2021-12-01', 0, 8, '2021-11-19 14:34:42', '2021-11-21 14:36:44'),
(121, '2021-01-01', 0, 9, '2021-11-20 22:23:16', '2021-11-21 14:36:44'),
(122, '2021-02-01', 0, 9, '2021-11-20 22:23:16', '2021-11-21 14:36:45'),
(123, '2021-03-01', 0, 9, '2021-11-20 22:23:16', '2021-11-21 14:36:45'),
(124, '2021-04-01', 0, 9, '2021-11-20 22:23:16', '2021-11-21 14:36:45'),
(125, '2021-05-01', 0, 9, '2021-11-20 22:23:17', '2021-11-21 14:36:45'),
(126, '2021-06-01', 0, 9, '2021-11-20 22:23:17', '2021-11-21 14:36:45'),
(127, '2021-07-01', 0, 9, '2021-11-20 22:23:17', '2021-11-21 14:36:45'),
(128, '2021-08-01', 0, 9, '2021-11-20 22:23:17', '2021-11-21 14:36:46'),
(129, '2021-09-01', 0, 9, '2021-11-20 22:23:17', '2021-11-21 14:36:46'),
(130, '2021-10-01', 0, 9, '2021-11-20 22:23:18', '2021-11-21 14:36:46'),
(131, '2021-11-01', 0, 9, '2021-11-20 22:23:18', '2021-11-21 14:36:46'),
(132, '2021-12-01', 0, 9, '2021-11-20 22:23:18', '2021-11-21 14:36:46');

INSERT INTO `facebook_ads_sets` (`id`, `ad_set_id`, `name`, `daily_budget`, `lifetime_budget`, `bid_amount`, `bid_strategy`, `billing_events`, `optimization_goal`, `status`, `targeting`, `promoted_object`, `created_time`, `start_time`, `campaign_id`, `user_id`, `created_at`, `updated_at`, `social_id`, `spend`, `page_id`) VALUES
(1, '23848639784430604', 'New Messages Ad Set', 0, 0, 0, NULL, NULL, NULL, 'ACTIVE', NULL, '{\"page_id\": \"100722998266407\"}', '0000-00-00 00:00:00', NULL, 31, 5, '2021-11-21 02:29:04', '2021-11-21 16:36:49', 8, 0, '100722998266407'),
(2, '23842940255780604', '4L Lead 1VN - 25-34', 0, 0, 0, NULL, NULL, NULL, 'ACTIVE', NULL, '{\"page_id\": \"1020267544764766\"}', '0000-00-00 00:00:00', NULL, 33, 5, '2021-11-21 02:29:04', '2021-11-21 16:36:51', 8, 0, NULL);

INSERT INTO `facebook_ads_social_accounts` (`id`, `account_id`, `social_account_id`, `created_at`, `updated_at`, `spend`) VALUES
(1, 'act_1388143858153379', 1, '2021-11-03 22:31:17', '2021-11-04 00:52:20', 2284902),
(2, 'act_577993945986051', 2, '2021-11-03 22:31:18', '2021-11-04 00:52:21', 954.6),
(3, 'act_348910279121495', 3, '2021-11-03 22:31:19', '2021-11-03 22:31:19', 0),
(4, 'act_360393014660039', 4, '2021-11-03 22:31:20', '2021-11-05 23:59:02', 949.29),
(5, 'act_177581899903390', 5, '2021-11-03 22:31:20', '2021-11-03 22:31:20', 0),
(6, 'act_335371351478432', 6, '2021-11-03 22:31:21', '2021-11-03 22:31:21', 0),
(7, 'act_1236256580039343', 7, '2021-11-04 00:38:22', '2021-11-04 00:38:22', 0),
(8, 'act_104084256372975', 8, '2021-11-04 10:18:31', '2021-11-04 10:18:31', 0),
(9, 'act_457532278760389', 9, '2021-11-04 12:14:00', '2021-11-04 12:14:00', 0),
(10, 'act_454312498649220', 14, '2021-11-07 19:08:28', '2021-11-07 19:08:28', 336.2),
(11, 'act_1320492491698772', 15, '2021-11-07 19:08:35', '2021-11-07 19:08:36', 327.82),
(12, 'act_3033124330292027', 16, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 0);

INSERT INTO `facebook_pages` (`id`, `avatar`, `name`, `page_id`, `access_token`, `created_at`, `updated_at`, `user_id`, `social_id`) VALUES
(2, 'https://scontent.xx.fbcdn.net/v/t1.6435-1/cp0/p50x50/92114116_100723181599722_4330644635845132288_n.png?_nc_cat=105&ccb=1-5&_nc_sid=dbb9e7&_nc_ohc=7637NX-X1YkAX-wqZNR&_nc_ht=scontent.xx&edm=AJdBtusEAAAA&oh=955f1b7380c82c0f4264d126db9aa757&oe=61BDFBA3', 'Just A Cool Bot', '100722998266407', NULL, '2021-11-21 14:18:39', '2021-11-21 14:18:39', 5, 8);

INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"0584c39b-c249-4165-b84a-5e7a41b06ccc\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"15\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:184:\\\"EAApBPpTXhQUBAIJSuS7EbSq69V8n93YuM2N8C02LUV7uvgBrMWZAC0sS3HL27gMuVAvFlusQXY0ABaE5rNTxKTYNo56kyQZBZAtQKSbIdvdjFtE6pPvXTG6zUvrMaNKGwaftzppWZBZCcM963QrGC5IWcRFMyKcXhRy0xPyZCwvXsMZCkQ1goA7\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637427721.0746\",\"type\":\"job\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"delay\":null,\"attempts\":2}', 'TypeError: Argument 1 passed to App\\Jobs\\CrawlFacebookAdsJob::__construct() must be an instance of App\\FacebookAdsSet, null given, called in /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Foundation/Bus/Dispatchable.php on line 17 and defined in /var/www/html/releases/9/app/Jobs/CrawlFacebookAdsJob.php:28\nStack trace:\n#0 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Foundation/Bus/Dispatchable.php(17): App\\Jobs\\CrawlFacebookAdsJob->__construct()\n#1 /var/www/html/releases/9/app/Services/FacebookAds/FacebookAdsSetService.php(114): App\\Jobs\\CrawlFacebookAdsJob::dispatch()\n#2 /var/www/html/releases/9/app/Jobs/CrawlFacebookAdsSetJob.php(40): App\\Services\\FacebookAds\\FacebookAdsSetService->getAllAdsSets()\n#3 /var/www/html/releases/9/app/Jobs/CrawlFacebookAdsSetJob.php(59): App\\Jobs\\CrawlFacebookAdsSetJob->crawlAdsSet()\n#4 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\CrawlFacebookAdsSetJob->handle()\n#5 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#6 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#7 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#8 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#9 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#10 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#11 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#13 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#14 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#15 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#16 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#17 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#18 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#19 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#20 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#21 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#22 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#23 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#24 /var/www/html/releases/9/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#25 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#26 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#27 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#28 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#29 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#30 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#31 /var/www/html/releases/9/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#32 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#33 /var/www/html/releases/9/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#34 /var/www/html/releases/9/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#35 /var/www/html/releases/9/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#36 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#37 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#38 /var/www/html/releases/9/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#39 {main}', '2021-11-21 00:02:02'),
(2, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"d93b6f54-19a1-4a51-af43-20d044131ced\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"18\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:183:\\\"EAApBPpTXhQUBAI77qUfZAmmn2Fy2bqTxmqc8Im9GYTRG0mYymLdZAfZCrZBDDqCNnat8ergGcrcQefnbP8bV7gm6aZB9QqrMwGsMSDjgSw8Q3dmJSaHtZC7IfmlQV9P2t9ljV3yq87BQNmsepHBYv4VElswMfbaV3edDxbxma1A4TD4J5MoeU4\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637431443.5305\",\"type\":\"job\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"delay\":null,\"attempts\":2}', 'TypeError: Argument 1 passed to App\\Jobs\\CrawlFacebookAdsJob::__construct() must be an instance of App\\FacebookAdsSet, null given, called in /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Foundation/Bus/Dispatchable.php on line 17 and defined in /var/www/html/releases/9/app/Jobs/CrawlFacebookAdsJob.php:28\nStack trace:\n#0 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Foundation/Bus/Dispatchable.php(17): App\\Jobs\\CrawlFacebookAdsJob->__construct()\n#1 /var/www/html/releases/9/app/Services/FacebookAds/FacebookAdsSetService.php(114): App\\Jobs\\CrawlFacebookAdsJob::dispatch()\n#2 /var/www/html/releases/9/app/Jobs/CrawlFacebookAdsSetJob.php(40): App\\Services\\FacebookAds\\FacebookAdsSetService->getAllAdsSets()\n#3 /var/www/html/releases/9/app/Jobs/CrawlFacebookAdsSetJob.php(59): App\\Jobs\\CrawlFacebookAdsSetJob->crawlAdsSet()\n#4 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\CrawlFacebookAdsSetJob->handle()\n#5 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#6 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#7 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#8 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#9 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(94): Illuminate\\Container\\Container->call()\n#10 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#11 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#12 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then()\n#13 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#14 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#15 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#16 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then()\n#17 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#18 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#19 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Jobs\\Job->fire()\n#20 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#21 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#22 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#23 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#24 /var/www/html/releases/9/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#25 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#26 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#27 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#28 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#29 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#30 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#31 /var/www/html/releases/9/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#32 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#33 /var/www/html/releases/9/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#34 /var/www/html/releases/9/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#35 /var/www/html/releases/9/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#36 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#37 /var/www/html/releases/9/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#38 /var/www/html/releases/9/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#39 {main}', '2021-11-21 01:04:06'),
(3, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"1188980a-ac06-420e-8e24-026b5dcb3c0b\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"3\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:186:\\\"EAApBPpTXhQUBAPsbcZBZAKHKtRAZAACjeZCEXejCWLOcLYtpUcuELZCerTJjTADr231icJvuekF2SaOL6cCSsOJktZCIpHJFIcjTvMKeBgrQZBG0Jzw1bA5d2kGza4anrO9GW4tscfXjiUbAN3yROeMMwZBs7TvTedvebV8rLQ8BZACNTO0UxbpNy\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637433777.0598\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/18/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/18/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/18/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/18/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/18/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/18/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 04:43:01'),
(4, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"7d62f9ab-3969-4a0e-b9bf-8f33a10cdf6b\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"6\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:182:\\\"EAApBPpTXhQUBAFXMZAyIvxmjRdnBYl8IZCrFSr6oXSPwC0NLid7Wosg4I682yezicceUe7Ud2OlT9d3ZCkaKy60chlcNsJagHfIeDzWdV8YKO8CfZC2da1NbImMjW4VDPYf9DVxVwvo4KhEeJwtScanTytWOF1f72BAPjwZC3xlVKKeEEpSj7\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637434124.3964\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/18/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/18/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/18/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/18/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/18/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/18/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 04:48:49'),
(5, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"205e5b32-59ba-4b51-9958-79316b298917\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"9\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:189:\\\"EAApBPpTXhQUBANPfFGZBViGwwZCo8hJYZC7t6ZA5rULWNYzAZALfSAtGHkotXjjnxcSiZBXmraZCJnqEAlQOoU7QU5zCOZCbwiD1xRPlg6CefZCiIZAkqy25DEU1ZACJHgJjyI2vlqprCLr4zL6qiHXQweYNGU8xtSuxTXWiHkTvxt22mwdZChaBbiaw\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637434467.6322\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/18/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/18/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/18/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/18/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/18/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/18/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 04:54:31'),
(6, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"9a43a611-58f4-48ae-8f86-0896aac3ecc9\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"12\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:187:\\\"EAApBPpTXhQUBADtvMwZCNb2qlCgtwlUNQIrqzqFDHLrXHEjWVziUOxfVtrMvtNYLuwRMJkflcUczynopso2t4scJeZBerrVnCuWanSMZAqx7u33XJHDZC1URlOBMk92OZCpZAiyUvXmVZAOdC6ZBfAgz80X4vCeFvTXib2dKZAuiTgItbuCZCLPly4\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637434555.7081\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/18/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/18/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/18/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/18/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/18/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/18/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 04:56:01'),
(7, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"2107a471-86bb-4df2-b6e8-256e816cf3b4\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"15\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:182:\\\"EAApBPpTXhQUBAPstE7ZAWhdxCpJ5OZBeRIx9g4usIlyI3ZAPRGzrYdFo1qQQHEZAzTAAB4p7G6aF5BnrUxvJptb2zOOWLH7T3N6O5s1EB7hPpTshLKjSSTg4yQbz4P0FVqBwoKLCQ1MknfuI7ykvZCi5UqbimOJmV1AnfbE56xxPWX7HaTHiU\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637436541.4596\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/18/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/18/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/18/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/18/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/18/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/18/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/18/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 05:29:08'),
(8, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"89857576-0416-4e4b-be79-853b9369cc61\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:31\"],\"id\":\"16\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:31;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:182:\\\"EAApBPpTXhQUBACSbLMhczL3tqKjpUwTot3jpjBfZC2YupUWHnbYWSph108kthMILHumYfaxqkfPBBIPZA9tOmyr0yhJl9IVtjLgNB6InCDXur7L5rGoIkgSelsmHCq8YT10w1r6xAwAboTUnsB8jEw5ZBxHzxsZBqJfVsJdGX5nvntTs5ZCSi\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637479118.9201\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/32/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/32/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/32/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/32/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/32/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/32/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 17:18:43'),
(9, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"8d1dbfd6-aa35-4903-9cf9-a9be3b7938c3\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"18\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:182:\\\"EAApBPpTXhQUBACSbLMhczL3tqKjpUwTot3jpjBfZC2YupUWHnbYWSph108kthMILHumYfaxqkfPBBIPZA9tOmyr0yhJl9IVtjLgNB6InCDXur7L5rGoIkgSelsmHCq8YT10w1r6xAwAboTUnsB8jEw5ZBxHzxsZBqJfVsJdGX5nvntTs5ZCSi\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637479118.9353\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/32/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/32/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/32/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/32/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/32/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/32/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 17:18:43'),
(10, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"78782437-ea0e-4ddc-a6a4-c64a5d8ae7d8\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:31\"],\"id\":\"19\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:31;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:185:\\\"EAApBPpTXhQUBAFLoYpHW5ywqZApcMszTtruVB5GBKm5tbCC3ZA35ZAQC1nibbgwrLyseeOox1BnCpq7ZBPT1bqjqqamUhXrU3S6rpYqIvCGRWT9RCfO5LGEAVeA6NAT24cQPao43WYPWZBWiXz0ZCfdIdGNRQImvobrEC0RGQcppfM9kTXBZCnZC\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637480204.4486\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/32/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/32/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/32/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/32/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/32/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/32/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 17:36:49'),
(11, 'redis', 'crawl_facebook_ads_set', '{\"uuid\":\"d4e11e86-4ea1-44b2-8c99-07adfb7e6e21\",\"timeout\":null,\"tags\":[\"App\\\\FacebookAdsCampaign:33\"],\"id\":\"21\",\"data\":{\"command\":\"O:31:\\\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\\":12:{s:5:\\\"tries\\\";i:3;s:41:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000campaign\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:23:\\\"App\\\\FacebookAdsCampaign\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:44:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000accessToken\\\";s:185:\\\"EAApBPpTXhQUBAFLoYpHW5ywqZApcMszTtruVB5GBKm5tbCC3ZA35ZAQC1nibbgwrLyseeOox1BnCpq7ZBPT1bqjqqamUhXrU3S6rpYqIvCGRWT9RCfO5LGEAVeA6NAT24cQPao43WYPWZBWiXz0ZCfdIdGNRQImvobrEC0RGQcppfM9kTXBZCnZC\\\";s:48:\\\"\\u0000App\\\\Jobs\\\\CrawlFacebookAdsSetJob\\u0000fbAdsSetService\\\";N;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:22:\\\"crawl_facebook_ads_set\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\"},\"displayName\":\"App\\\\Jobs\\\\CrawlFacebookAdsSetJob\",\"timeoutAt\":null,\"pushedAt\":\"1637480204.4669\",\"type\":\"job\",\"maxExceptions\":null,\"maxTries\":3,\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"delay\":null,\"attempts\":3}', 'Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\CrawlFacebookAdsSetJob has been attempted too many times or run too long. The job may have previously timed out. in /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:648\nStack trace:\n#0 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(436): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(346): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(306): Illuminate\\Queue\\Worker->process()\n#3 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(132): Illuminate\\Queue\\Worker->runJob()\n#4 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#5 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /var/www/html/releases/32/vendor/laravel/horizon/src/Console/WorkCommand.php(46): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Horizon\\Console\\WorkCommand->handle()\n#8 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#9 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#10 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#11 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Container/Container.php(596): Illuminate\\Container\\BoundMethod::call()\n#12 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#13 /var/www/html/releases/32/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#14 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#15 /var/www/html/releases/32/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#16 /var/www/html/releases/32/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#17 /var/www/html/releases/32/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#18 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#19 /var/www/html/releases/32/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#20 /var/www/html/releases/32/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#21 {main}', '2021-11-21 17:36:52');

INSERT INTO `industries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Clothing', NULL, NULL),
(2, 'Shoes', NULL, NULL),
(3, 'Baby', NULL, NULL),
(4, 'Health', NULL, NULL),
(5, 'Jewelry', NULL, NULL),
(6, 'Kid', NULL, NULL),
(7, 'Adult', NULL, NULL),
(8, 'Beauty', NULL, NULL),
(9, 'Home', NULL, NULL),
(10, 'Household Appliance', NULL, NULL),
(11, 'Outdoor', NULL, NULL),
(12, 'Book', NULL, NULL),
(13, 'Boutique', NULL, NULL),
(14, 'Electronic', NULL, NULL),
(15, 'Eyewear', NULL, NULL),
(16, 'Flower', NULL, NULL),
(17, 'Food', NULL, NULL),
(18, 'Game', NULL, NULL),
(19, 'Garden', NULL, NULL),
(20, 'Grocery', NULL, NULL),
(21, 'Office', NULL, NULL),
(22, 'Sport', NULL, NULL),
(23, 'Travel', NULL, NULL),
(24, 'Wedding', NULL, NULL),
(25, 'Automotive', NULL, NULL),
(26, 'Hobby', NULL, NULL),
(27, 'Music', NULL, NULL),
(28, 'Drink', NULL, NULL),
(29, 'Home Decor', NULL, NULL),
(30, 'Rental', NULL, NULL),
(31, 'Accessory', NULL, NULL),
(32, 'Animal', NULL, NULL),
(33, 'Firearm', NULL, NULL);

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_17_172600_create_schedule_table', 1),
(4, '2021_03_10_175242_create_schedule_histories_table', 1),
(5, '2021_03_11_171148_add_run_in_background_table_schedule', 1),
(6, '2021_03_16_171148_add_custom_command', 1),
(7, '2021_03_17_141053_add_options_field_schedules_table', 1),
(8, '2021_03_17_141336_add_options_field_schedules_histories_table', 1),
(9, '2021_05_26_175355_add_avatar_to_users_table', 1),
(10, '2021_05_27_144412_create_posts_table', 1),
(11, '2021_05_27_144429_create_categories_table', 1),
(12, '2021_05_27_144442_create_tags_table', 1),
(13, '2021_05_27_144457_create_post_category_table', 1),
(14, '2021_05_27_144511_create_post_tag_table', 1),
(15, '2021_05_27_162854_add_phone_number_to_users_table', 1),
(16, '2021_05_29_163157_add_active_to_users_table', 1),
(17, '2021_05_29_200857_create_media_table', 1),
(18, '2021_05_29_200941_create_media_categories_table', 1),
(19, '2021_05_30_003821_add_user_to_media_table', 1),
(20, '2021_05_30_090358_add_feature_image_to_posts_table', 1),
(21, '2021_05_30_112403_create_post_metas_table', 1),
(22, '2021_05_30_190213_add_type_to_posts_table', 1),
(23, '2021_05_31_071854_create_scripts_table', 1),
(24, '2021_05_31_090828_create_contact_forms_table', 1),
(25, '2021_05_31_105115_create_contacts_table', 1),
(26, '2021_05_31_105237_create_contact_form_replies_table', 1),
(27, '2021_05_31_151121_create_settings_table', 1),
(28, '2021_06_03_115340_create_activity_log_table', 1),
(29, '2021_06_03_145058_add_ip_to_activity_log_table', 1),
(30, '2021_06_14_093248_add_column_status_to_posts', 1),
(31, '2021_06_14_110007_add_column_scheduled_time_to_posts', 1),
(32, '2021_06_17_105046_add_send_mail_success_schedules_table', 1),
(33, '2021_06_27_234957_create_qr_codes_table', 1),
(34, '2021_06_30_230048_create_faqs_table', 1),
(35, '2021_07_03_213953_update_column_status_draft_to_posts_table', 1),
(36, '2021_07_19_175608_add_published_at_to_posts_table', 1),
(37, '2021_11_02_170758_create_facebook_pages_table', 2),
(38, '2021_11_03_12200_create_data_sources_table', 3),
(39, '2021_11_03_124208_create_social_accounts_table', 3),
(40, '2021_11_03_211136_create_facebook_ads_social_accounts_table', 4),
(41, '2021_11_03_211345_create_facebook_ads_campaigns_table', 4),
(42, '2021_11_03_233945_add_spend_to_facebook_ads_social_accounts_table', 5),
(43, '2021_11_04_000826_create_facebook_ads_insights_table', 5),
(44, '2021_11_16_102901_create_industries_table', 6),
(45, '2021_11_16_103121_add_industry_id_to_users_table', 6),
(46, '2021_11_16_135115_add_user_id_to_social_accounts_table', 6),
(47, '2021_11_17_224415_create_user_selected_accounts_table', 7),
(48, '2021_11_12_115225_add_log_success_and_log_error_to_schedules_table', 8),
(49, '2021_11_18_220635_create_roas_reports_table', 8),
(50, '2021_11_18_224000_add_industry_id_to_user_selected_accounts_table', 8),
(51, '2021_11_19_105313_add_user_selected_account_id_to_roas_reports_table', 9),
(52, '2021_11_19_123655_create_facebook_ads_sets_table', 10),
(53, '2021_11_19_140202_add_user_id_to_facebook_ads_campaigns_table', 10),
(54, '2021_11_18_122342_add_log_filename_to_schedules_table', 11),
(55, '2021_11_20_224240_create_failed_jobs_table', 12),
(56, '2021_11_20_230137_create_facebook_ads_table', 13),
(57, '2021_11_20_230615_create_facebook_ad_creatives_table', 13),
(60, '2021_11_21_001658_add_social_id_to_facebook_ads_sets_table', 14),
(63, '2021_11_21_002553_add_user_id_to_facebook_pages_table', 15),
(64, '2021_11_21_020909_add_page_id_to_user_selected_accounts_table', 15),
(65, '2021_11_21_130810_add_spend_to_facebook_ads_sets_table', 15);

INSERT INTO `roas_reports` (`id`, `monthly_traffic`, `ads_spent`, `industry_id`, `created_at`, `updated_at`, `user_selected_account_id`) VALUES
(1, 87, 0, 5, '2021-11-21 15:07:20', '2021-11-21 15:07:20', 1);

INSERT INTO `social_accounts` (`id`, `name`, `logo_src`, `social_id`, `access_token`, `note`, `data_source_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '1388143858153379', NULL, 'act_1388143858153379', 'EAApBPpTXhQUBALsPPdYWfp9RYq8AQkI6yktiTcP1ctwb8mb7Yc0PPUNTzvOnDtTv1pmWNZADnhWxqTKC7SZCdFGfZCF5eIS9LILdMOzEZAsuNK27SOblmV4TV9njsVIONlzKWyYHZBZC8uZAurCmWgpfpaXvaocnnkqitdF1ZB6nwpJz4islfzMH9FSMeqI4jJgZD', 'Cập nhật token thành công', 4, '2021-11-03 22:31:17', '2021-11-06 01:29:12', 1),
(2, 'Lhian Cadungog Francisco', NULL, 'act_577993945986051', 'EAApBPpTXhQUBAF82Pe48vIzcLveyNmhgnoKpWEH6b4crPjv4K0ZBgcxU8JqOqjqZCNpbRweZBZCBckkf0kPolMfaS1oujCWR28z4gprAWHlAjU9ofaWbRxmS9NZAZCnFODHZATs9pcLuY52YIbxK42vshXGvEfqqWFqCWq5dBuyLAAMN4T1CIGVxVXbpcwfPVwZD', 'Cập nhật token thành công', 4, '2021-11-03 22:31:18', '2021-11-06 01:29:17', 1),
(3, 'Minh Thư', NULL, 'act_348910279121495', 'EAApBPpTXhQUBAKv16i71mFCz5C6LKxssYQePK5GPtZBZAnSLCS0EgRPqDQ6B4HXZCCapmnVLC0at2YHijsoSGNafIdqNvxgZA6A7wZC6zQbmE4KnBCJm8cwzfxNwfsxYFDXhEUZAt6WeY9yT8alQEtGv2KFQFLYCuscufsqjuY5KijiAKZAa0ySdLOPzZBZBWBvcZD', 'Cập nhật token thành công', 4, '2021-11-03 22:31:19', '2021-11-06 01:29:22', 1),
(4, 'Rowilyn Mae', NULL, 'act_360393014660039', 'EAApBPpTXhQUBAKGcaZAafdptxGkCZCSLcssEGYMETEAxZB1L3pDceODA4mPN7fxEi7xHlVeBtZBuAlVCyMOpmTyXIwGShJZBXLWdmVTQHtJyBZAzQzUKu0AvejnZANm1X4VVloPnAM0QOGRM3tMTW8qVvnjPYvCoyXDR65jIntZAdEsO0XkjXBZBeeV7QRF5U9G0ZD', 'Cập nhật token thành công', 4, '2021-11-03 22:31:20', '2021-11-06 01:29:27', 1),
(5, 'Glydel Cruz', NULL, 'act_177581899903390', 'EAApBPpTXhQUBAJRbtOerLw9UUuyAcpTYf6ZAaJCZBcjX7gnkYNrlKclZCiCIbDxqWQLmOM1ghBxdIsmrktt6S75GSck7wVL8YZCvZCyQzysM6OGvEyrWfbJqZAYIumPZCVa8ZBQqgk2JX5TpkoJ1Q214OSM5iXdUApRACb8gmHWsqhlJTXjETih8uyHynadxtWEZD', 'Cập nhật token thành công', 4, '2021-11-03 22:31:20', '2021-11-06 01:29:32', 1),
(6, 'Alvin Lumic Berano', NULL, 'act_335371351478432', 'EAApBPpTXhQUBACYtstCM3FZAUpeZB73YOXLAQ2ZA0Cuwx3IwVyVze97YzzJVTgvcFrspHZAXMRdaqRvm1DeZBbAPHdfaW8pxEbay9myJABXDOMOWmZAahiDqErrK4UorZBEsCWHqSrFLuCvcbCyC9Fun3cQpaP525zSZBXTQfhFqxqhKjY7wTppCl2wygUjhZBFMZD', 'Cập nhật token thành công', 4, '2021-11-03 22:31:21', '2021-11-06 01:29:36', 1),
(7, 'EP Bot', NULL, 'act_1236256580039343', 'EAApBPpTXhQUBABPx8Iq037R7caR0N8W2R3ZCTbRazTsBYkyJB6zZAg7valrNgwU6LDIbRlfqiU13IBCPDHqHcZAYOOd0q9LZB6rrL8N7asHpchZC9417DpePe8aG6ZBZA48x3n8qWQcLYGgZA2SHlHLbTxN8ZC0SGzWk8sEm6sHAfVG5rnp6ZBZAsoJ', 'Cập nhật token thành công', 4, '2021-11-04 00:38:22', '2021-11-04 10:17:46', 1),
(8, 'Hoang Ngan', NULL, 'act_104084256372975', 'EAApBPpTXhQUBAFLoYpHW5ywqZApcMszTtruVB5GBKm5tbCC3ZA35ZAQC1nibbgwrLyseeOox1BnCpq7ZBPT1bqjqqamUhXrU3S6rpYqIvCGRWT9RCfO5LGEAVeA6NAT24cQPao43WYPWZBWiXz0ZCfdIdGNRQImvobrEC0RGQcppfM9kTXBZCnZC', 'Cập nhật token thành công', 4, '2021-11-04 10:18:31', '2021-11-21 14:36:41', 5),
(9, 'test', NULL, 'act_457532278760389', 'EAApBPpTXhQUBAHkm432A97T6Ur7jDotknIEi5u2FVedVe3i1oBlATjZB0kWNyMGOLqeRJwo0leRIOsZCELygex5yccWiEIZC5HzRpyRGHjR3n6swlzlOIu6cL0VvPX1ZAT3D0Yw2xpA9RzbwWXd1abER03qBwQCiZCOdCsczy0t5Ns6eNvmbt', 'Cập nhật token thành công', 4, '2021-11-04 12:14:00', '2021-11-21 14:36:44', 5),
(13, 'ash.barbour97@gmail.com', NULL, 'ash.barbour97@gmail.com', '1//0gzS--rbkT8DCCgYIARAAGBASNwF-L9IrIsaYlnl4u7DEHZX83imePiGljNsJoh9rOQJylMzL4h44Ix2uCQPI0mrAIAqbquZQ6ks', 'Cập nhật token thành công', 9, '2021-11-05 18:58:34', '2021-11-05 18:58:34', 1),
(14, '454312498649220', NULL, 'act_454312498649220', 'EAApBPpTXhQUBADaTcanl98hQjMSEvMjd0e4AzceiFeqftGntehwQp98baBZAvff6ZAWuOob2lPSPJOaVg5ZBQBYfZBjHyu4B7wOUtZCq52KHOwpCC4Ug07cGsroSZASBOH48dl3CI23ZBkrckoi72SKN95rviDVE2bk2qeZCAvOeVYa0kWiI16onOsT9ZBnJQ9d8ZD', 'Cập nhật token thành công', 4, '2021-11-07 19:08:28', '2021-11-07 19:08:28', 1),
(15, 'Yazey.com', NULL, 'act_1320492491698772', 'EAApBPpTXhQUBAODnE50LIeCvYZBhymsDuOQUhSRx6BgRdyZCwUZAOKAMavnCQW6yX17XsYZAQaCJY2kUfq04EO5c67iajFod6IoaPwzyG0CH08xrA5UBkZAxhNXtFIRfgsYz5wc61wFGHzENdWKbtGSd7IRQCZCu6EwkO2f9Ns3YwV2kzzBtJh0CPgdzqcbBEZD', 'Cập nhật token thành công', 4, '2021-11-07 19:08:35', '2021-11-07 19:08:35', 1),
(16, 'Ash Barbour', NULL, 'act_3033124330292027', 'EAApBPpTXhQUBAOWLHjFVrGbzLrhTrhnAggh7T5TDPETLjaOBGmUHta4k1KASPOKZBfXUts89LNrFL014OgwBh9Acu6ZAQFhc9w99GsJ27O5cHrEP8oTkIKjWI4ElnTgg5ZBDPrcQoJeYH6FPPIGRKYZB3ImDGsLChpQSulZC8YTUQo6RcmdoyySWrrBkVnz4ZD', 'Cập nhật token thành công', 4, '2021-11-07 19:08:41', '2021-11-07 19:08:41', 1),
(17, 'ngan.nguyen@eastplayers.io', NULL, 'ngan.nguyen@eastplayers.io', '1//0d0EE_YnmHvF4CgYIARAAGA0SNwF-L9IrD32BoYQfUKoJt9utWstJWIHTa-OGsciv8jLbdYqFebp_3l17YcE2wX_MR06oW2UKytc', 'Cập nhật token thành công', 9, '2021-11-16 16:28:36', '2021-11-21 16:01:26', 5);

INSERT INTO `user_selected_accounts` (`id`, `view_id`, `user_id`, `google_analytics_account_id`, `facebook_ads_account_id`, `created_at`, `updated_at`, `industry_id`, `page_id`) VALUES
(1, 247685883, 5, 17, 8, '2021-11-18 01:16:50', '2021-11-21 16:06:23', 5, '100722998266407'),
(2, NULL, 1, 1, NULL, '2021-11-19 15:44:07', '2021-11-19 15:44:07', 1, NULL);

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `remember_token`, `token`, `is_verify`, `expired_token_date`, `created_at`, `updated_at`, `avatar`, `phone_number`, `is_active`, `industry_id`) VALUES
(1, 'sonnt.dev@gmail.com', 'sonnt.dev@gmail.com', NULL, '$2y$10$9Fw/UNd5aJV42QFZtDeNx.3Dgy7p5Xpue8d2ZWjFgrM5dmGqP57lW', '', '2kP21HyfS8hvl9TE3unMTcfGTNeSBxydhcfefrx793dUg4dkNcfp5766dXJc', NULL, 1, '2021-11-02 22:49:41', '2021-11-01 22:49:41', '2021-11-16 16:28:05', '', '', 0, 1),
(2, 'hello@eastplayers.io', 'hello@eastplayers.io', NULL, '$2y$10$43D72mFUGYE0s1rpmTl0denCxBLPsoDZOg.LMm5DdwOHR30sS/nHW', '', NULL, 'ot8cW93sQw', 0, '2021-11-02 23:01:17', '2021-11-01 23:01:17', '2021-11-01 23:01:17', '', '', 0, NULL),
(3, 'ash@yazey.com', 'ash@yazey.com', NULL, '$2y$10$aUk0DT3EJVZfqNfPVFQpkOApKmm1uysn1vB.iM2ZV/w32EKTAfD6a', '', '9FbklPfhFTJYZAMvFvZcILQDaR1NVcVNwGc92elcqS9ONs2soDsx9DGLUyaw', NULL, 1, '2021-11-02 23:13:59', '2021-11-01 23:13:59', '2021-11-01 23:14:52', '', '', 0, NULL),
(4, 'scottish.foldep@gmail.com', 'scottish.foldep@gmail.com', NULL, '$2y$10$3Sb8uqgcCMZ06NneZ8XqKOIzh3EvpcK7nAi4t1ZyGSnw5yq2RY5Me', '', 'aKLp7cwabQFERK6oTdYbVdaqAdrygPORdBXeJxDLDb5zZyYutf8gsJqfNYi2', NULL, 1, '2021-11-02 23:14:11', '2021-11-01 23:14:11', '2021-11-01 23:14:52', '', '', 0, NULL),
(5, 'ngan.nguyen@eastplayers.io', 'ngan.nguyen@eastplayers.io', NULL, '$2y$10$IQ65saaJufSDEAEk3Dv7aebpA5LPQiQhjBJwWkAtUhPUjRRtIsbbe', '', NULL, 'iU2aw386h9', 0, '2021-11-04 20:53:41', '2021-11-03 20:53:41', '2021-11-16 15:07:18', '', '', 0, 5);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;