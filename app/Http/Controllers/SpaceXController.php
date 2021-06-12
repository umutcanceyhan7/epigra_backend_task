<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpaceXController extends Controller
{
    //
    static function fetchData()
    {
        $d['capsules'] = Http::get("https://api.spacexdata.com/v3/capsules")->body();
        return $d;
    }
}
