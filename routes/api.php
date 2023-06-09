<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\DistrictController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

#----------------------------------module auth
Route::controller(AuthController::class)->group(function (){
    Route::post('/register','register');
    Route::post('/login','login');
    Route::post('/logout','logout')->middleware('auth:sanctum');
});
#---------------------------------module setting
Route::get('/setting',SettingController::class);
#---------------------------------module cities
Route::get('/citing',CityController::class);
#-----------------------------------module district

// Route::get('/districting/{city_id}',DistrictController::class);
Route::get('/districting',DistrictController::class);
Route::post('/messages',MessageController::class);

#-------------------------------------module domains
Route::get('/domains',DomainController::class);