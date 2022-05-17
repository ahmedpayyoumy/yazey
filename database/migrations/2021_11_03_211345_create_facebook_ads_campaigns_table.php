<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookAdsCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook_ads_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id');
            $table->string('name');
            $table->enum('objective', ['APP_INSTALLS', 'BRAND_AWARENESS', 'CONVERSIONS', 'EVENT_RESPONSES', 'LEAD_GENERATION', 'LINK_CLICKS', 'LOCAL_AWARENESS', 'MESSAGES', 'OFFER_CLAIMS', 'PAGE_LIKES', 'POST_ENGAGEMENT', 'PRODUCT_CATALOG_SALES', 'REACH', 'STORE_VISITS', 'VIDEO_VIEWS']);
            $table->dateTime('created_time')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('stop_time')->nullable();
            $table->enum('status', ['ACTIVE', 'PAUSED', 'DELETED', 'ARCHIVED'])->nullable();

            $table->unsignedBigInteger('ad_account_id')->nullable();
            $table->foreign('ad_account_id')->references('id')->on('facebook_ads_social_accounts');
            $table->unsignedBigInteger('social_id')->nullable();
            $table->foreign('social_id')->references('id')->on('social_accounts');
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
        Schema::dropIfExists('facebook_ads_campaigns');
    }
}
