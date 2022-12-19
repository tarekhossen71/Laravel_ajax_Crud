<?php

namespace App\Listeners;

use App\Jobs\UserRegister;
use App\Events\UserMailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserMailNotificationListener
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
     * @param  \App\Events\UserMailEvent  $event
     * @return void
     */
    public function handle(UserMailEvent $event)
    {
        UserRegister::dispatch(request()->all())->delay(now()->addSeconds(10));
    }
}
