<?php

namespace App\Console\Commands;
use App\Models\Topic;

use Illuminate\Console\Command;

class save_topic_view_to_db extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save_topic_view_to_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $topics = Topic::all();
        foreach($topics as $topic){
            $view_count = visits($topic)->count();
            $topic->view_count = $view_count;
            $topic->timestamps = false;
    	    $topic->save();
        }
    }
}
