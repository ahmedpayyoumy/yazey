<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('logo_src')->nullable();
            $table->string('social_id');
            $table->text('access_token')->nullable();
            $table->text('note')->nullable();

            $table->unsignedBigInteger('data_source_id');
            $table->foreign('data_source_id')->references('id')->on('data_sources');
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
        Schema::dropIfExists('social_accounts');
    }
}
