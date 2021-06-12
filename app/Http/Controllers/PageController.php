<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SpaceXController;

class PageController extends Controller
{
    //
    function index()
    {
        $d['capsules'] = SpaceXController::fetchData();
        return view('spaceX', $d);
    }
}
