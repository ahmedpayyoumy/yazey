<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSelectedAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_selected_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('view_id')->nullable();

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('google_analytics_account_id')->nullable();
            $table->foreign('google_analytics_account_id')->references('id')->on('social_accounts');
            $table->unsignedBigInteger('facebook_ads_account_id')->nullable();
            $table->foreign('facebook_ads_account_id')->references('id')->on('social_accounts');
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
        Schema::dropIfExists('user_selected_accounts');
    }
}
