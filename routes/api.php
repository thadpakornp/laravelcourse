<?php

use App\Http\Controllers\LineController;
use App\Http\Controllers\ControllerHaveResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('protectapi')->prefix('v1')->group(function () {
    // Route::get('/index', [LineController::class, 'index']);
    Route::post('/getLineData', [LineController::class, 'getLineData'])->name('getLineData');
});


// Route::prefix('v1')->group(function () {
//     Route::post('/login', [LineController::class, 'login']);
// });

// Route::resource('/users', [ControllerHaveResource::class]);
