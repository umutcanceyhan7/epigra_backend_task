<?php

namespace App\Console\Commands;

use App\Models\spaceXModel;
use Illuminate\Console\Command;

class SaveSpaceXDataToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SaveSpaceXDataToDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command saves the fetched data to database. If you did not fetch data yet, you can use "FetchSpaceXData" command!';

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
        
        return "şimdilik bir şey yok";
    }
}
