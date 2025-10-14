<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\System\SystemLanguageController;
use App\Http\Controllers\Api\System\CurrencyController;
use App\Http\Controllers\Api\System\ExchangeRateController;
use App\Http\Controllers\Api\System\AuditLogController;

Route::get('/health', fn () => ['ok' => true, 'ts' => now()->toIso8601String()]);

Route::prefix('system')->group(function () {
    Route::get('languages',  [SystemLanguageController::class, 'index']);
    Route::post('languages', [SystemLanguageController::class, 'store']);
    Route::get('currencies', [CurrencyController::class, 'index']);
    Route::post('currencies', [CurrencyController::class, 'store']);
    Route::put('currencies/{code}', [CurrencyController::class, 'update']);
    Route::delete('currencies/{code}', [CurrencyController::class, 'destroy']);
    Route::post('currencies/{code}/toggle', [CurrencyController::class, 'toggle']);

    // Exchange Rates
    Route::get('exchange-rates', [ExchangeRateController::class, 'index']);
    Route::post('exchange-rates', [ExchangeRateController::class, 'store']);
    Route::post('exchange-rates/toggle', [ExchangeRateController::class, 'toggle']);

    // Audit Logs (read-only)
    Route::get('audit-logs', [AuditLogController::class, 'index']);
});
