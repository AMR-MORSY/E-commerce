<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderDetailsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderDetailsEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
       Mail::to($event->user_email)->send(new OrderDetailsMail($event->order));
    }
}
