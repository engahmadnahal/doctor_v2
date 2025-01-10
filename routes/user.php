<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\AppointmentController;
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

Route::prefix('cms/user/')
    ->middleware(['auth:user'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('cms.dashboard');


        Route::controller(AppointmentController::class)
            ->name('appointments.user.')
            ->prefix('appointments')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
            });
    });
