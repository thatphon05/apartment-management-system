<?php

use App\Http\Controllers\Admins\BookingController;
use App\Http\Controllers\Admins\BuildingController;
use App\Http\Controllers\Admins\ConfigurationController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\InvoiceController;
use App\Http\Controllers\Admins\ProfileController;
use App\Http\Controllers\Admins\RepairController;
use App\Http\Controllers\Admins\RoomController;
use App\Http\Controllers\Admins\SummaryController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Admins\UtilityExpenseController;
use App\Http\Controllers\Auths\AuthController;
use App\Http\Controllers\Users\BookingController as UserBookingController;
use App\Http\Controllers\Users\DashboardController as UserDashboardController;
use App\Http\Controllers\Users\InvoiceController as UserInvoiceController;
use App\Http\Controllers\Users\ProfileController as UserProfileController;
use App\Http\Controllers\Users\RepairController as UserRepairController;
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
    Route::middleware(['auth', 'active.user'])->group(function () {
        // Dashboard
        Route::controller(UserDashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
        });

        // Repair
        Route::resource('repairs', UserRepairController::class)->except(['destroy', 'edit', 'update']);

        // Invoice and payment
        Route::prefix('invoices')->name('invoices.')->group(function () {
            Route::get('/', [UserInvoiceController::class, 'index'])->name('index');
            Route::get('{invoice}', [UserInvoiceController::class, 'show'])->name('show');
            Route::post('/{invoice}', [UserInvoiceController::class, 'createPayment'])->name('payment.create');
            Route::post('/{invoice}/update', [UserInvoiceController::class, 'updatePayment'])->name('payment.update');
            Route::get('/{invoice}/receipt', [UserInvoiceController::class, 'downloadReceipt'])->name('download-receipt');
        });

        // Change self password
        Route::get('profile/change-password', [UserProfileController::class, 'getChangePassword'])
            ->name('profile.change-password.get');
        Route::post('profile/change-password', [UserProfileController::class, 'postChangePassword'])
            ->name('profile.change-password.post');

        // Booking view details
        Route::get('bookings/{booking}', [UserBookingController::class, 'show'])->name('bookings.show');
        Route::get('bookings/{booking}/rent-contract', [UserBookingController::class, 'downloadRentContract'])
            ->name('booking.download-rent-contract');
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
        Route::get('users/id-card-copy/{filename}', [UserController::class, 'downloadIdCardCopy'])
            ->name('users.download.id-card-copy');
        Route::get('users/house-copy/{filename}', [UserController::class, 'downloadHouseRegCopy'])
            ->name('users.download.house-copy');

        // Room Configuration management
        Route::resource('configurations', ConfigurationController::class)->except(['show', 'destroy']);

        // Building management
        Route::resource('buildings', BuildingController::class)->only(['index', 'show']);

        // Room management
        Route::resource('rooms', RoomController::class)->only(['show', 'edit', 'update']);

        // Booking
        Route::get('bookings/{id}', [BookingController::class, 'show'])
            ->name('booking.show');
        Route::patch('bookings/{id}', [BookingController::class, 'cancelBooking'])
            ->name('booking.booking-cancel');
        Route::get('bookings/create', [BookingController::class, 'create'])
            ->name('booking.create');
        Route::post('bookings', [BookingController::class, 'store'])
            ->name('booking.store');
        Route::get('bookings/edit/{id}', [BookingController::class, 'getEditBooking'])
            ->name('booking.edit.get');
        Route::post('bookings/edit/{id}', [BookingController::class, 'postEditBooking'])
            ->name('booking.edit.post');

        /// For download rent contract
        Route::get('bookings/rent-contract/{filename}', [RoomController::class, 'downloadRentContract'])
            ->name('booking.download.rent-contract');

        // Repair management
        Route::resource('repairs', RepairController::class)->only(['index', 'edit', 'update']);

        // Invoice management
        Route::resource('invoices', InvoiceController::class)->except(['destroy', 'edit']);

        // Download receipt
        Route::get('invoices/{invoice}/receipt', [InvoiceController::class, 'downloadReceipt'])->name('invoices.receipt');

        // Update payment status
        Route::patch('payments/{id}/update', [InvoiceController::class, 'updatePayment'])->name('payments.update');

        Route::prefix('summary')->group(function () {
            // Summary month report
            Route::get('month', [SummaryController::class, 'summaryMonth'])
                ->name('summary.summary-month');
            Route::post('month', [SummaryController::class, 'exportSummaryPdf'])
                ->name('summary.export-summary-pdf');

            // Summary overdue
            Route::get('overdue', [SummaryController::class, 'summaryOverdue'])
                ->name('summary.summary-overdue');
            Route::post('overdue', [SummaryController::class, 'exportOverduePdf'])
                ->name('summary.export-overdue-pdf');
        });

        // Download payment attach file
        Route::get('payments/payment-attach/{filename}', [InvoiceController::class, 'downloadPaymentAttach'])
            ->name('payments.download.payment-attach');

        // Utility Expense management
        Route::resource('expenses', UtilityExpenseController::class)->except(['destroy', 'show']);

        // Change self password
        Route::get('profile/change-password', [ProfileController::class, 'getChangePassword'])
            ->name('profile.change-password.get');
        Route::post('profile/change-password', [ProfileController::class, 'postChangePassword'])
            ->name('profile.change-password.post');
    });
});
