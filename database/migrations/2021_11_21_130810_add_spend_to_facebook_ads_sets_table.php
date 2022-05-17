<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpendToFacebookAdsSetsTable extends Migration
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
            $table->double('spend')->default(0);
            $table->string('page_id')->nullable();
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
            $table->dropColumn('spend');
            $table->dropColumn('page_id');
        });
    }
}
