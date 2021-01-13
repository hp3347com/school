<?php

namespace App\Listeners;

use App\Events\SignUp;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\Userlog as UserLogs;

class UserLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SignUp  $event
     * @return void
     */
    public function handle(SignUp $event)
    {
        Log::info($event->type,['user_id'=>$event->user_id,'ext'=>$event->ext]);
        UserLogs::create([
            'user_id'=>$event->user_id ,
            'event'=>$event->type,
            'params'=>$event->ext,
            'admin_id'=>0,
            'create_time'=>time()
        ]);
    }
}
