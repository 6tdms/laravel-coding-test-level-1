<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/events',[EventController::class,'allEvents']);
Route::get('/v1/events/active-events',[EventController::class,'activeEvents']);
Route::get('/v1/events/{id}',[EventController::class,'show']);
Route::post('/v1/events',[EventController::class,'create']);
Route::put('/v1/events/{id}',[EventController::class,'createOrUpdate']);
Route::patch('/v1/events/{id}',[EventController::class,'update']);
Route::delete('/v1/events/{id}',[EventController::class,'destroy']);
