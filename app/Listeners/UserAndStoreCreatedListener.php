<?php

namespace App\Listeners;

use App\Events\UserAndStoreCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\SendNotificationForNewStore;

class UserAndStoreCreatedListener
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
     * @param  UserAndStoreCreated  $event
     * @return void
     */
    public function handle(UserAndStoreCreated $event)
    {
        $event->user->notify(new SendNotificationForNewStore());
    }
}
