<?php

use App\Http\Controllers\ApiLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceXApiController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// You can login using
Route::prefix('/user')->group(function () {
    Route::post('/login', [ApiLoginController::class, 'login']);
});


Route::get('/capsules', [SpaceXApiController::class, 'index']);
Route::get('/capsules', [SpaceXApiController::class, 'showByFilter']);
Route::post('/capsules', [SpaceXApiController::class, 'store']);
Route::get('/capsules/{capsule_serial}', [SpaceXApiController::class, 'show']);
Route::put('/capsules/{capsule_serial}', [SpaceXApiController::class, 'update']);
Route::delete('/capsules/{capsule_serial}', [SpaceXApiController::class, 'destroy']);
