<?php

namespace App\Console\Commands;

use App\Http\Controllers\SpaceXController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Events\SpaceXDataFetchEvent;
use App\Events\SyncSpaceXDataToDatabaseEvent;
use App\Models\SpaceXApiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * Checks if the missions property is array or not.
     * If it is array serializes it to store in database
     * else returns it as so.
     */

    public function checkMissionsProperty($missionsProperty)
    {
        if (is_array($missionsProperty)) {
            $missions = serialize($missionsProperty);
        } else {
            $missions = $missionsProperty;
        }
        return $missions;
    }

    public function assignProperties($model, $dataArray)
    {
        $model->capsule_serial = $dataArray['capsule_serial'];
        $model->capsule_id = $dataArray['capsule_id'];
        $model->status = $dataArray['status'];
        $model->original_launch = $dataArray['original_launch'];
        $model->original_launch_unix = $dataArray['original_launch_unix'];
        $model->landings = $dataArray['landings'];
        $model->type = $dataArray['type'];
        $model->details = $dataArray['details'];
        $model->reuse_count = $dataArray['reuse_count'];
    }

    public function fetchDataAndReturnDecodedData($url)
    {
        # fetch data from api using HTTP::get request
        $rawData = Http::get('https://api.spacexdata.com/v3/capsules');

        # decode fetched data and turn it to array.
        $decodedData = json_decode($rawData, true);

        return $decodedData;
    }

    /**
     * Fetch data from api with get request, fires an event
     * Loops through every fetched objects and checks if the objects in array or not.
     * If there is an object with same serial then update the fetched data
     * Else create a new object in database.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://api.spacexdata.com/v3/capsules';

        $rawCapsulesDataArray = $this->fetchDataAndReturnDecodedData($url);
        # fire an event/listener when fetch process starts
        event(new SpaceXDataFetchEvent());

        # loop all capsules and store them to database

        foreach ($rawCapsulesDataArray as $capsule) {
            
            $tempUpdateModel = SpaceXApiModel::where('capsule_serial', $capsule['capsule_serial'])->first();

            # If the same id model is in database just update and save to database,
            # else create new model and save to database.

            if ($tempUpdateModel) {

                $missions = $this->checkMissionsProperty($capsule['missions']);

                $tempUpdateModel->missions = $missions;

                $this->assignProperties($tempUpdateModel, $capsule);

                $tempUpdateModel->save();
            } else {

                $tempModel = new SpaceXApiModel();

                $missions = $this->checkMissionsProperty($capsule['missions']);

                $tempModel->missions = $missions;

                $this->assignProperties($tempModel, $capsule);

                $tempModel->save();
            }
        }
        # fire an event/listener when store process finishes.
        event(new SyncSpaceXDataToDatabaseEvent());
        Log::channel('spacexapilog')->info(json_encode($rawCapsulesDataArray));
    }
}
