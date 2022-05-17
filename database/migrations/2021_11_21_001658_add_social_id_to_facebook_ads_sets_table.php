<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialIdToFacebookAdsSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facebook_ads_sets', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('social_id')->nullable();
            $table->foreign('social_id')->references('id')->on('social_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facebook_ads_sets', function (Blueprint $table) {
            //
            $table->dropForeign(['social_id']);
            $table->dropColumn('social_id');
        });
    }
}
