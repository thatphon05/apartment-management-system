<?php

use App\Http\Controllers\Admins\BookingController;
use App\Http\Controllers\Admins\BuildingController;
use App\Http\Controllers\Admins\ConfigurationController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\InvoiceController;
use App\Http\Controllers\Admins\RepairController;
use App\Http\Controllers\Admins\RoomController;
use App\Http\Controllers\Admins\SummaryController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Admins\UtilityExpenseController;
use App\Http\Controllers\Auths\AuthController;
use App\Http\Controllers\Users\DashboardController as UserDashboardController;
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
        Route::get('login', 'getUserLogin')->name('login.get');
        Route::post('login', 'postUserLogin')->name('login.post');
        Route::get('logout', 'userLogout')->name('logout');
    });

    // After user login
    Route::middleware('auth')->group(function () {

        // Dashboard
        Route::controller(UserDashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
        });

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

        // Dashboard
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
        });

        // User management
        Route::resource('users', UserController::class)->except(['destroy']);

        // Download file
        Route::get('users/idcardcopy/{filename}', [UserController::class, 'downloadIdCardCopy'])
            ->name('users.download.idcardcopy');
        Route::get('users/housecopy/{filename}', [UserController::class, 'downloadHouseRegCopy'])
            ->name('users.download.housecopy');

        // Room Configuration management
        Route::resource('configurations', ConfigurationController::class)->only(['index', 'edit', 'update']);

        // Building management
        Route::resource('buildings', BuildingController::class)->only(['index', 'show']);

        // Room management
        Route::resource('rooms', RoomController::class)->only(['show', 'edit', 'update']);

        // Booking
        Route::patch('bookings/{id}', [BookingController::class, 'cancelBooking'])
            ->name('booking.booking-cancel');

        /// For download rent contract
        Route::get('bookings/rentcontract/{filename}', [RoomController::class, 'downloadRentContract'])
            ->name('booking.download.rent_contract');

        // Repair management
        Route::resource('repairs', RepairController::class)->only(['index', 'edit', 'update']);

        // Invoice and Payment management
        Route::resource('invoices', InvoiceController::class)->except(['destroy']);
        Route::patch('payments/{id}/update', [InvoiceController::class, 'updatePayment'])->name('payments.update');

        // Summary report
        Route::get('summary', [SummaryController::class, 'index'])
            ->name('summary.index');
        Route::post('summary', [SummaryController::class, 'exportPdf'])
            ->name('summary.export-pdf');

        // Download payment attach file
        Route::get('payments/paymentattach/{filename}', [InvoiceController::class, 'downloadPaymentAttach'])
            ->name('payments.download.payment_attach');

        // Utility Expense management
        Route::resource('expenses', UtilityExpenseController::class)->except(['destroy']);

    });
});
