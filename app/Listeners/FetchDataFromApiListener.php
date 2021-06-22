<?php

namespace App\Listeners;

use App\Events\SpaceXDataFetchEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class FetchDataFromApiListener
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
     * @param  SpaceXDataFetchEvent  $event
     * @return void
     */
    public function handle(SpaceXDataFetchEvent $event)
    {
        print('Fetch process is started');
    }
}
