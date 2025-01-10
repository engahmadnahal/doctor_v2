<?php

use App\Http\Controllers\Auth\AuthController as GeneralAuthController;
use App\Http\Controllers\Doctor\AuthController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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

Route::prefix('cms')->middleware('guest:admin,doctor,user')->group(function () {
    Route::get('{guard}/login', [GeneralAuthController::class, 'showLogin'])->name('cms.login');
    Route::post('login', [GeneralAuthController::class, 'login']);


});


Route::prefix('cms')->middleware('auth:admin,doctor,user')->group(function () {

    Route::get('profile/personal', [GeneralAuthController::class, 'profilePersonalInformatiion'])->name('cms.profile.personal-information');
    Route::put('profile/personal', [GeneralAuthController::class, 'updateProfilePersonalInformation'])->name('cms.profile.update-personal-information');

    Route::get('profile/account', [GeneralAuthController::class, 'profileAccountInformatiion'])->name('cms.profile.account-information');

    Route::get('profile/change-password', [GeneralAuthController::class, 'editPassword'])->name('cms.profile.change-password');

    Route::post('change-password', [GeneralAuthController::class, 'updatePassword']);

});



Route::prefix('cms/doctor/register')
    ->middleware('guest:doctor')
    ->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/', 'index')->name('cms.doctor.register');
            Route::post('/', 'register');
            Route::get('/success-register', 'successRegister');
        });
    });


Route::prefix('cms/user/register')
    ->middleware('guest:user')
    ->group(function () {
        Route::controller(UserAuthController::class)->group(function () {
            Route::get('/', 'index')->name('cms.user.register');
            Route::post('/', 'register');
            Route::get('/success-register', 'successUserRegister');
        });
    });


Route::prefix('cms/user/')->middleware('auth:user,admin,doctor')->group(function () {
    Route::get('logout', [GeneralAuthController::class, 'logout'])->name('cms.logout');
});
