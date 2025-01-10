<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\PatientController;
use Illuminate\Support\Facades\Route;
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

Route::prefix('cms/doctor/')->middleware(['auth:doctor'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('cms.dashboard');

    Route::controller(AppointmentController::class)
        ->name('appointments.')
        ->prefix('appointments')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/accept', 'accept')->name('accept');
            Route::post('/reject', 'reject')->name('reject');
        });

    Route::controller(PatientController::class)
        ->prefix('patients')
        ->name('patients.')
        ->group(function () {

            Route::get('/','index')->name('index');
            Route::get('/{user}/data','getReportUserData')->name('user-data');

        });
});
