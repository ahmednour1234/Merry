<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\Auth\LoginController;
use App\Http\Controllers\Office\Auth\OtpController;
use App\Http\Controllers\Office\Auth\PasswordResetController;
use App\Http\Controllers\Office\Auth\RegisterController;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\CvController;
use App\Http\Controllers\Office\BookingController;
use App\Http\Controllers\Office\SubscriptionController;
use App\Http\Controllers\Office\ProfileController;
use App\Http\Controllers\Office\NotificationController;
use App\Http\Controllers\Office\ReportController;
use App\Http\Controllers\Office\SettingsController;

Route::prefix('office')->name('office.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Guest routes (auth pages)
    |--------------------------------------------------------------------------
    */
    Route::middleware('guest:office-panel')->group(function () {
        Route::get('/login',           [LoginController::class, 'showLogin'])->name('login');
        Route::post('/login',          [LoginController::class, 'login'])->name('login.post');

        Route::get('/register',        [RegisterController::class, 'showRegister'])->name('register');
        Route::post('/register',       [RegisterController::class, 'register'])->name('register.post');

        Route::get('/login-otp',       [OtpController::class, 'showLoginOtp'])->name('otp');
        Route::post('/login-otp',      [OtpController::class, 'verifyLoginOtp'])->name('otp.verify');
        Route::post('/login-otp/resend', [OtpController::class, 'resendOtp'])->name('otp.resend');

        Route::get('/forget-password', [PasswordResetController::class, 'showForgetPassword'])->name('password.request');
        Route::post('/forget-password',[PasswordResetController::class, 'sendCode'])->name('password.send');

        Route::get('/reset-password',  [PasswordResetController::class, 'showResetPassword'])->name('password.reset');
        Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated routes
    |--------------------------------------------------------------------------
    */
    Route::middleware([
        'auth:office-panel',
        \App\Http\Middleware\CheckOfficeActive::class,
    ])->group(function () {

        // Logout
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.alt');

        // CVs
        Route::get('/cvs',              [CvController::class, 'index'])->name('cvs.index');
        Route::get('/cvs/create',       [CvController::class, 'create'])->name('cvs.create');
        Route::post('/cvs',             [CvController::class, 'store'])->name('cvs.store');
        Route::get('/cvs/{id}/edit',    [CvController::class, 'edit'])->name('cvs.edit');
        Route::post('/cvs/{id}',        [CvController::class, 'update'])->name('cvs.update');
        Route::post('/cvs/{id}/delete', [CvController::class, 'destroy'])->name('cvs.destroy');
        Route::get('/cvs/{id}/download',[CvController::class, 'download'])->name('cvs.download');

        // Bookings
        Route::get('/bookings',              [BookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');

        // Subscriptions (action routes already exist via web.php, keeping here too)
        Route::get('/subscriptions',                          [SubscriptionController::class, 'index'])->name('subscriptions.index');
        Route::post('/subscriptions/subscribe',               [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
        Route::post('/subscriptions/{id}/toggle-auto-renew', [SubscriptionController::class, 'toggleAutoRenew'])->name('subscriptions.toggle-auto-renew');
        Route::post('/subscriptions/{id}/cancel',            [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
        Route::post('/subscriptions/{id}/renew',             [SubscriptionController::class, 'renew'])->name('subscriptions.renew');

        // Profile
        Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Notifications
        Route::get('/notifications',                        [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{id}/mark-read',        [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
        Route::post('/notifications/read-all',              [NotificationController::class, 'markAllRead'])->name('notifications.read-all');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // Settings
        Route::get('/settings',  [SettingsController::class, 'edit'])->name('settings.edit');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});
