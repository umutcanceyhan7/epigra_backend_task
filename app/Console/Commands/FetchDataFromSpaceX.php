<?php

namespace App\Console\Commands;

use App\Http\Controllers\SpaceXController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Events\SpaceXDataFetchEvent;
use App\Events\SyncSpaceXDataToDatabaseEvent;
use App\Models\SpaceXApiModel;
use Illuminate\Http\Request;

class FetchDataFromSpaceX extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FetchDataFromSpaceX';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches data from SpaceX Api and sync data to database. When fetch starts and sync finishes, it fires an event/listener.';

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
        # fetch data from api using HTTP::get request
        $rawCapsulesData = Http::get('https://api.spacexdata.com/v3/capsules');
        # fire an event/listener when fetch process starts
        event(new SpaceXDataFetchEvent());
        # decode fetched data and turn it to array.
        $rawCapsulesDataArray = json_decode($rawCapsulesData, true);

        # loop all capsules and store them to database
        foreach ($rawCapsulesDataArray as $capsule) {
            if (is_array($capsule['missions'])) {
                $missions = serialize($capsule['missions']);
            } else {
                $missions = $capsule['missions'];
            }
            $tempModel = new SpaceXApiModel();
            $tempModel->capsule_serial = $capsule['capsule_serial'];
            $tempModel->capsule_id = $capsule['capsule_id'];
            $tempModel->status = $capsule['status'];
            $tempModel->original_launch = $capsule['original_launch'];
            $tempModel->original_launch_unix = $capsule['original_launch_unix'];
            $tempModel->missions = $missions;
            $tempModel->landings = $capsule['landings'];
            $tempModel->type = $capsule['type'];
            $tempModel->details = $capsule['details'];
            $tempModel->reuse_count = $capsule['reuse_count'];
            $tempModel->save();
        }
        # fire an event/listener when store process finishes.
        event(new SyncSpaceXDataToDatabaseEvent());
    }
}
