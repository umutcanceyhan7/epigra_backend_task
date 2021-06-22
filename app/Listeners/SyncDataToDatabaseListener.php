<?php

namespace App\Listeners;

use App\Events\SyncSpaceXDataToDatabaseEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class SyncDataToDatabaseListener
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
     * @param  SyncSpaceXDataToDatabaseEvent  $event
     * @return void
     */
    public function handle(SyncSpaceXDataToDatabaseEvent $event)
    {
        print('Sync datas to database process completed!');
    }
}
