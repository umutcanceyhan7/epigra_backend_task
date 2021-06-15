<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceXController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dene', [SpaceXController::class, 'index']);
Route::post('/dene', [SpaceXController::class, 'store']);
Route::get('/dene/{id}', [SpaceXController::class, 'show']);
Route::put('/dene/{id}', [SpaceXController::class, 'update']);
Route::delete('/dene/{id}', [SpaceXController::class, 'destroy']);
