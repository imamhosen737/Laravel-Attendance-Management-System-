<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ShiftAssignController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('attendance_custom', [AttendanceController::class,'custom'])->name('att_custom');
Route::get('attendance', [AttendanceController::class,'report'])->name('att');
Route::resource('employee', EmployeeController::class);
Route::resource('shift', ShiftController::class);
Route::resource('holiday',HolidayController::class);
Route::resource('shift_assign',ShiftAssignController::class);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
