<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookAdsSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook_ads_sets', function (Blueprint $table) {
            $table->id();
            $table->string('ad_set_id');
            $table->string('name');
            $table->unsignedInteger('daily_budget')->default(0);
            $table->unsignedInteger('lifetime_budget')->default(0);
            $table->unsignedInteger('bid_amount')->default(0);
            $table->enum('bid_strategy', ['LOWEST_COST_WITHOUT_CAP', 'LOWEST_COST_WITH_BID_CAP', 'COST_CAP'])->nullable();
            $table->enum('billing_events', ['APP_INSTALLS', 'IMPRESSIONS', 'LINK_CLICKS', 'NONE', 'OFFER_CLAIMS', 'PAGE_LIKES', 'POST_ENGAGEMENT', 'THRUPLAY', 'PURCHASE', 'LISTING_INTERACTION'])->nullable();
            $table->enum('optimization_goal', ['NONE', 'APP_INSTALLS', 'BRAND_AWARENESS', 'AD_RECALL_LIFT', 'CLICKS', 'ENGAGED_USERS', 'EVENT_RESPONSES', 'IMPRESSIONS', 'LEAD_GENERATION', 'QUALITY_LEAD', 'LINK_CLICKS', 'OFFER_CLAIMS', 'OFFSITE_CONVERSIONS', 'PAGE_ENGAGEMENT', 'PAGE_LIKES', 'POST_ENGAGEMENT', 'QUALITY_CALL', 'REACH', 'SOCIAL_IMPRESSIONS', 'APP_DOWNLOADS', 'TWO_SECOND_CONTINUOUS_VIDEO_VIEWS', 'LANDING_PAGE_VIEWS', 'VISIT_INSTAGRAM_PROFILE', 'VALUE', 'THRUPLAY', 'REPLIES', 'DERIVED_EVENTS', 'CONVERSATIONS'])->nullable();
            $table->enum('status', ['ACTIVE', 'PAUSED', 'DELETED', 'ARCHIVED'])->nullable();
            $table->json('targeting')->nullable();
            $table->json('promoted_object')->nullable();
            $table->dateTime('created_time')->nullable();
            $table->dateTime('start_time')->nullable();

            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->foreign('campaign_id')->references('id')->on('facebook_ads_campaigns');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facebook_ads_sets');
    }
}
