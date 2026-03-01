<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/docs/postman.json', function () {
    $path = storage_path('app/private/scribe/collection.json');
    abort_unless(is_file($path), 404, 'Postman collection not found');
    return response()->file($path, ['Content-Type' => 'application/json']);
});

Route::prefix('office')->middleware(['auth:office-panel'])->group(function () {
    Route::get('/subscriptions', [\App\Http\Controllers\Office\SubscriptionController::class, 'index'])->name('office.subscriptions');
    Route::post('/subscriptions/subscribe', [\App\Http\Controllers\Office\SubscriptionController::class, 'subscribe'])->name('office.subscriptions.subscribe');
    Route::post('/subscriptions/{id}/toggle-auto-renew', [\App\Http\Controllers\Office\SubscriptionController::class, 'toggleAutoRenew'])->name('office.subscriptions.toggle-auto-renew');
    Route::post('/subscriptions/{id}/cancel', [\App\Http\Controllers\Office\SubscriptionController::class, 'cancel'])->name('office.subscriptions.cancel');
});
