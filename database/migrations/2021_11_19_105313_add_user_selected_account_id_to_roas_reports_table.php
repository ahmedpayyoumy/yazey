<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserSelectedAccountIdToRoasReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roas_reports', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_selected_account_id')->nullable();
            $table->foreign('user_selected_account_id')->references('id')->on('user_selected_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roas_reports', function (Blueprint $table) {
            //
            $table->dropColumn('user_selected_account_id');
        });
    }
}
