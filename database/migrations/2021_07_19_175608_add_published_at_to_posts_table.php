<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Post;

class AddPublishedAtToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dateTime('published_at', $precision = 0)->nullable();
        });
        $posts = Post::where([])->get();
        foreach ($posts as $post) {
            if ($post->status === Post::STATUS_PUBLISHED) {
                $post->published_at = $post->updated_at;
            } elseif ($post->status === Post::STATUS_SCHEDULED) {
                $post->published_at = $post->scheduled_time;
            } else {
                $post->published_at = $post->created_at;
            }
            $post->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
    }
}
