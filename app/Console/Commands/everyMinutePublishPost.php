<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\Post;

class everyMinutePublishPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:posts';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getPostScheduleds = Post::where('status','scheduled')
                                            ->where('scheduled_time', '<=', Carbon::now())
                                            ->get();
        foreach($getPostScheduleds as $item){
            $item->update([
                'scheduled_time' => null,
                'status' => "published",
            ]);
        }
        $this->info('Posts published');
        return 0;
    }
}
