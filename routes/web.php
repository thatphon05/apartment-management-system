<?php

use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\SettingController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Auths\AuthController;
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

/**
 * User page
 */
Route::prefix('/')->name('user.')->group(function () {

    // User login
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'getUserLogin')->name('login.get');
        Route::post('/login', 'postUserLogin')->name('login.post');
        Route::get('logout', 'userLogout')->name('logout');
    });

    // After user login
    Route::middleware('auth')->group(function () {

        Route::get('/', function () {
            return 'dashboard';
        })->name('dashboard');

    });
});

/**
 * Admin page
 */
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin login
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'getAdminLogin')->name('login.get');
        Route::post('login', 'postAdminLogin')->name('login.post');
        Route::get('logout', 'adminLogout')->name('logout');
    });

    // After admin login
    Route::middleware('auth.admin')->group(function () {

        // dashboard
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
        });

        // User management
        Route::resource('users', UserController::class);

        // Setting management
        Route::resource('settings', SettingController::class)->only(['index', 'edit', 'update']);

    });
});
