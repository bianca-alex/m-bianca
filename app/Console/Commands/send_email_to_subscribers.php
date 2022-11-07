<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Topic;
use App\Models\Subscribe;
use Carbon\Carbon;
use App\Mail\SendSubscribers;

class send_email_to_subscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_email_to_subscribers';

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

        $topics = Topic::where('created_at', '>', Carbon::now()->subDays(7))->get(['id','title','created_at']);
        $data = [];
        $data['topics'] = $topics;
        $subscribes = Subscribe::where('flag','1')->get();
        foreach($subscribes as $subscribe){
            $data['user'] = $subscribe->user->email;
            \Mail::send(new SendSubscribers($data));
        }
    }
}
