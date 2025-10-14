<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\System\SystemLanguageController;
use App\Http\Controllers\Api\System\CurrencyController;
use App\Http\Controllers\Api\System\ExchangeRateController;
use App\Http\Controllers\Api\System\AuditLogController;
use App\Http\Controllers\Api\System\UserController;
use App\Http\Controllers\Api\System\RoleController;
use App\Http\Controllers\Api\System\PermissionController;
use App\Http\Controllers\Api\System\InsuranceCompanyController;


Route::get('/health', fn () => ['ok' => true, 'ts' => now()->toIso8601String()]);

// ===== Auth (عام) =====
Route::prefix('v1')->group(function () {
    Route::post('auth/login',  [AuthController::class, 'login']);
    Route::post('auth/logout', [AuthController::class, 'logout'])
        ->middleware('auth:sanctum');
});

// ===== Admin/System APIs (محميّة) =====
// ملاحظة: بنحتفظ بـ ability عامة (system.manage) + بنحط perm مخصص لكل Endpoint
Route::prefix('v1/admin/system')
    ->middleware(['auth:sanctum', 'ability:system.manage'])
    ->group(function () {

        // ===== Languages =====
        Route::get('languages',  [SystemLanguageController::class, 'index'])
            ->middleware('perm:system.languages.index');
        Route::post('languages', [SystemLanguageController::class, 'store'])
            ->middleware('perm:system.languages.store');

        // ===== Currencies =====
        Route::get('currencies', [CurrencyController::class, 'index'])
            ->middleware('perm:system.currencies.index');
        Route::post('currencies', [CurrencyController::class, 'store'])
            ->middleware('perm:system.currencies.store');
        Route::put('currencies/{code}', [CurrencyController::class, 'update'])
            ->middleware('perm:system.currencies.update');
        Route::delete('currencies/{code}', [CurrencyController::class, 'destroy'])
            ->middleware('perm:system.currencies.destroy');
        Route::post('currencies/{code}/toggle', [CurrencyController::class, 'toggle'])
            ->middleware('perm:system.currencies.toggle');

        // ===== Exchange Rates =====
        Route::get('exchange-rates', [ExchangeRateController::class, 'index'])
            ->middleware('perm:system.exchange_rates.index');
        Route::post('exchange-rates', [ExchangeRateController::class, 'store'])
            ->middleware('perm:system.exchange_rates.store');
        Route::post('exchange-rates/toggle', [ExchangeRateController::class, 'toggle'])
            ->middleware('perm:system.exchange_rates.toggle');

        // ===== Audit Logs (read-only) =====
        Route::get('audit-logs', [AuditLogController::class, 'index'])
            ->middleware('perm:system.audit_logs.index');

        // ===== Users =====
        Route::get('users', [UserController::class, 'index'])
            ->middleware('perm:system.users.index');
        Route::post('users', [UserController::class, 'store'])
            ->middleware('perm:system.users.store');
        Route::put('users/{id}', [UserController::class, 'update'])
            ->middleware('perm:system.users.update');
        Route::delete('users/{id}', [UserController::class, 'destroy'])
            ->middleware('perm:system.users.destroy');
        Route::post('users/{id}/toggle', [UserController::class, 'toggle'])
            ->middleware('perm:system.users.toggle');
        Route::post('users/{id}/sync-roles', [UserController::class, 'syncRoles'])
            ->middleware('perm:system.users.sync_roles');
        // (اختياري) ربط صلاحيات مباشرة للمستخدم:
        // Route::post('users/{id}/sync-permissions', [UserController::class, 'syncPermissions'])
        //     ->middleware('perm:system.users.sync_permissions');

        // ===== Roles =====
        Route::get('roles', [RoleController::class, 'index'])
            ->middleware('perm:system.roles.index');
        Route::post('roles', [RoleController::class, 'store'])
            ->middleware('perm:system.roles.store');
        Route::put('roles/{id}', [RoleController::class, 'update'])
            ->middleware('perm:system.roles.update');
        Route::delete('roles/{id}', [RoleController::class, 'destroy'])
            ->middleware('perm:system.roles.destroy');
        Route::post('roles/{id}/toggle', [RoleController::class, 'toggle'])
            ->middleware('perm:system.roles.toggle');
        Route::post('roles/{id}/sync-permissions', [RoleController::class, 'syncPermissions'])
            ->middleware('perm:system.roles.sync_permissions');

        // ===== Permissions =====
        Route::get('permissions', [PermissionController::class, 'index'])
            ->middleware('perm:system.permissions.index');
        Route::post('permissions', [PermissionController::class, 'store'])
            ->middleware('perm:system.permissions.store');
        Route::put('permissions/{id}', [PermissionController::class, 'update'])
            ->middleware('perm:system.permissions.update');
        Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])
            ->middleware('perm:system.permissions.destroy');
        Route::post('permissions/{id}/toggle', [PermissionController::class, 'toggle'])
            ->middleware('perm:system.permissions.toggle');

        // ===== Insurance Companies =====
        Route::get('insurance-companies', [InsuranceCompanyController::class, 'index'])
    ->middleware('perm:system.insurance_companies.index');
Route::post('insurance-companies', [InsuranceCompanyController::class, 'store'])
    ->middleware('perm:system.insurance_companies.store');
Route::put('insurance-companies/{id}', [InsuranceCompanyController::class, 'update'])
    ->middleware('perm:system.insurance_companies.update');
Route::delete('insurance-companies/{id}', [InsuranceCompanyController::class, 'destroy'])
    ->middleware('perm:system.insurance_companies.destroy');
Route::post('insurance-companies/{id}/toggle', [InsuranceCompanyController::class, 'toggle'])
    ->middleware('perm:system.insurance_companies.toggle');
    });
