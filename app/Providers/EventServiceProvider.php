<?php

namespace App\Providers;

use App\Events\SpaceXDataFetchEvent;
use App\Events\SyncSpaceXDataToDatabaseEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SpaceXDataFetchEvent::class => [
            \App\Listeners\FetchDataFromApiListener::class,
        ],
        SyncSpaceXDataToDatabaseEvent::class => [
            \App\Listeners\SyncDataToDatabaseListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
