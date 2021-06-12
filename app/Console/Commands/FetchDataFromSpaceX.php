<?php

namespace App\Console\Commands;

use App\Http\Controllers\SpaceXController;
use Illuminate\Console\Command;

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
    protected $description = 'Fetch Space X Data To Controller';

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
        $spaceXData = SpaceXController::fetchData();
        return $spaceXData;
    }
}
