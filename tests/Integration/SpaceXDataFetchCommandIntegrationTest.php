<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

use App\Events\SpaceXDataFetchEvent;
use App\Events\SyncSpaceXDataToDatabaseEvent;
use Illuminate\Support\Facades\Artisan;

class SpaceXDataFetchCommandIntegrationTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_command_can_fetch_data_from_spacex_api()
    {
        # Call command it returns count of fetched data
        $this->artisan('FetchDataFromSpaceX')->expectsOutput('Success')->doesntExpectOutput('Fail');
    }
}
