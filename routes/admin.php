<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
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

Route::prefix('cms/admin/')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('cms.dashboard');

    Route::controller(AppointmentController::class)
        ->name('appointments.admin.')
        ->prefix('appointments')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });


        Route::controller(PatientController::class)
        ->prefix('patients')
        ->name('patients.admin.')
        ->group(function () {
            Route::get('/','index')->name('index');
            Route::post('/','store')->name('store');
            Route::post('/{user}','update')->name('update');
            Route::delete('/{user}','destroy')->name('destroy');
        });


        Route::controller(DoctorController::class)
        ->prefix('doctor')
        ->name('doctor.admin.')
        ->group(function () {
            Route::get('/','index')->name('index');
            Route::post('/','store')->name('store');
            Route::post('/{doctor}','update')->name('update');
            Route::delete('/{doctor}','destroy')->name('destroy');
        });

});
