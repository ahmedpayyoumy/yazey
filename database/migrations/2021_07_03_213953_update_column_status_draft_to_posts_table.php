<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnStatusDraftToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE posts CHANGE COLUMN status status ENUM('published', 'scheduled', 'draft') NOT NULL DEFAULT 'published'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE posts CHANGE COLUMN status status ENUM('published', 'scheduled') NOT NULL DEFAULT 'published'");
        });
    }
}
