<?php

namespace App\Listeners;

use App\Mail\BrandCreate;
use App\Events\BrandCreateMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BrandSendMail
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
     * @param  \App\Events\BrandCreateMail  $event
     * @return void
     */
    public function handle(BrandCreateMail $event)
    {
        $data = request()->all();
        Mail::to('tarekhossen.offi@gmail.com')->send(new BrandCreate($data));
    }
}
