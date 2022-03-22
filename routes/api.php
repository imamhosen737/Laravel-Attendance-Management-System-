<?php

use App\Http\Controllers\LogController;
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
Route::post('/user',[LogController::class,'user'])->middleware('cors');
Route::get('/time_log',[LogController::class,'show'])->middleware('cors');
Route::post('/time_log/save',[LogController::class,'create'])->middleware('cors');
Route::get('/attandance_report',[LogController::class,'attandance_report'])->middleware('cors');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
