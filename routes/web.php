<?php

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
    Route::get('/login', function () {
        return 'user login form';
    })->name('login');

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
    Route::get('/login', function () {
        return 'admin login form';
    })->name('login');

    // After admin login
    Route::middleware('auth.admin')->group(function () {

        Route::get('/', function () {
            return 'dashboard';
        })->name('dashboard');

    });
});
