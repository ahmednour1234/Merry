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
use App\Http\Controllers\Api\System\CityController;
use App\Http\Controllers\Api\System\OfficeController;
use App\Http\Controllers\Api\System\PlanController;
use App\Http\Controllers\Api\System\CouponController;
use App\Http\Controllers\Api\System\PromotionController;
use App\Http\Controllers\Api\System\NationalityController;

use App\Http\Controllers\Api\Office\AuthOfficeController;
use App\Http\Controllers\Api\Office\FcmTokenController;
use App\Http\Controllers\Api\Office\SubscriptionController;

Route::get('/health', fn () => ['ok' => true, 'ts' => now()->toIso8601String()]);

/*
|--------------------------------------------------------------------------
| Public Auth (system users)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    Route::post('auth/login',  [AuthController::class, 'login']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

/*
|--------------------------------------------------------------------------
| Admin / System (protected)
| Sanctum + general ability `system.manage` + per-endpoint permission `perm:*`
|--------------------------------------------------------------------------
*/
Route::prefix('v1/admin/system')
    ->middleware(['auth:sanctum', 'ability:system.manage'])
    ->group(function () {

        // Languages
        Route::get('languages',  [SystemLanguageController::class, 'index'])->middleware('perm:system.languages.index');
        Route::post('languages', [SystemLanguageController::class, 'store'])->middleware('perm:system.languages.store');

        // Currencies
        Route::get('currencies', [CurrencyController::class, 'index'])->middleware('perm:system.currencies.index');
        Route::post('currencies', [CurrencyController::class, 'store'])->middleware('perm:system.currencies.store');
        Route::put('currencies/{code}', [CurrencyController::class, 'update'])->middleware('perm:system.currencies.update');
        Route::delete('currencies/{code}', [CurrencyController::class, 'destroy'])->middleware('perm:system.currencies.destroy');
        Route::post('currencies/{code}/toggle', [CurrencyController::class, 'toggle'])->middleware('perm:system.currencies.toggle');

        // Exchange Rates
        Route::get('exchange-rates', [ExchangeRateController::class, 'index'])->middleware('perm:system.exchange_rates.index');
        Route::post('exchange-rates', [ExchangeRateController::class, 'store'])->middleware('perm:system.exchange_rates.store');
        Route::post('exchange-rates/toggle', [ExchangeRateController::class, 'toggle'])->middleware('perm:system.exchange_rates.toggle');

        // Audit Logs (read-only)
        Route::get('audit-logs', [AuditLogController::class, 'index'])->middleware('perm:system.audit_logs.index');

        // Users
        Route::get('users', [UserController::class, 'index'])->middleware('perm:system.users.index');
        Route::post('users', [UserController::class, 'store'])->middleware('perm:system.users.store');
        Route::put('users/{id}', [UserController::class, 'update'])->middleware('perm:system.users.update');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware('perm:system.users.destroy');
        Route::post('users/{id}/toggle', [UserController::class, 'toggle'])->middleware('perm:system.users.toggle');
        Route::post('users/{id}/sync-roles', [UserController::class, 'syncRoles'])->middleware('perm:system.users.sync_roles');
        Route::post('users/{id}/sync-permissions', [UserController::class, 'syncPermissions'])->middleware('perm:system.users.sync_permissions');

        // Roles
        Route::get('roles', [RoleController::class, 'index'])->middleware('perm:system.roles.index');
        Route::post('roles', [RoleController::class, 'store'])->middleware('perm:system.roles.store');
        Route::put('roles/{id}', [RoleController::class, 'update'])->middleware('perm:system.roles.update');
        Route::delete('roles/{id}', [RoleController::class, 'destroy'])->middleware('perm:system.roles.destroy');
        Route::post('roles/{id}/toggle', [RoleController::class, 'toggle'])->middleware('perm:system.roles.toggle');
        Route::post('roles/{id}/sync-permissions', [RoleController::class, 'syncPermissions'])->middleware('perm:system.roles.sync_permissions');

        // Permissions
        Route::get('permissions', [PermissionController::class, 'index'])->middleware('perm:system.permissions.index');
        Route::post('permissions', [PermissionController::class, 'store'])->middleware('perm:system.permissions.store');
        Route::put('permissions/{id}', [PermissionController::class, 'update'])->middleware('perm:system.permissions.update');
        Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->middleware('perm:system.permissions.destroy');
        Route::post('permissions/{id}/toggle', [PermissionController::class, 'toggle'])->middleware('perm:system.permissions.toggle');

        // Insurance Companies
        Route::get('insurance-companies', [InsuranceCompanyController::class, 'index'])->middleware('perm:system.insurance_companies.index');
        Route::post('insurance-companies', [InsuranceCompanyController::class, 'store'])->middleware('perm:system.insurance_companies.store');
        Route::put('insurance-companies/{id}', [InsuranceCompanyController::class, 'update'])->middleware('perm:system.insurance_companies.update');
        Route::delete('insurance-companies/{id}', [InsuranceCompanyController::class, 'destroy'])->middleware('perm:system.insurance_companies.destroy');
        Route::post('insurance-companies/{id}/toggle', [InsuranceCompanyController::class, 'toggle'])->middleware('perm:system.insurance_companies.toggle');

        // Cities
        Route::get('cities', [CityController::class, 'index'])->middleware('perm:system.cities.index');
        Route::post('cities', [CityController::class, 'store'])->middleware('perm:system.cities.store');
        Route::put('cities/{id}', [CityController::class, 'update'])->middleware('perm:system.cities.update');
        Route::delete('cities/{id}', [CityController::class, 'destroy'])->middleware('perm:system.cities.destroy');
        Route::post('cities/{id}/toggle', [CityController::class, 'toggle'])->middleware('perm:system.cities.toggle');

        // Offices (admin)
        Route::get('offices', [OfficeController::class, 'index'])->middleware('perm:system.offices.index');
        Route::post('offices', [OfficeController::class, 'store'])->middleware('perm:system.offices.store');
        Route::put('offices/{id}', [OfficeController::class, 'update'])->middleware('perm:system.offices.update');
        Route::post('offices/{id}/block', [OfficeController::class, 'block'])->middleware('perm:system.offices.block');
        Route::post('offices/{id}/toggle', [OfficeController::class, 'toggle'])->middleware('perm:system.offices.toggle');
        Route::delete('offices/{id}', [OfficeController::class, 'destroy'])->middleware('perm:system.offices.destroy');

        // Plans
        Route::get('plans', [PlanController::class, 'index'])->middleware('perm:system.plans.index');
        Route::post('plans', [PlanController::class, 'store'])->middleware('perm:system.plans.store');
        Route::put('plans/{code}', [PlanController::class, 'update'])->middleware('perm:system.plans.update');
        Route::delete('plans/{code}', [PlanController::class, 'destroy'])->middleware('perm:system.plans.destroy');
        Route::post('plans/{code}/toggle', [PlanController::class, 'toggle'])->middleware('perm:system.plans.toggle');
        Route::post('plans/{code}/translations', [PlanController::class, 'upsertTranslation'])->middleware('perm:system.plans.translations');
        Route::post('plans/{code}/features', [PlanController::class, 'syncFeatures'])->middleware('perm:system.plans.features');

        // Coupons
        Route::get('coupons', [CouponController::class, 'index'])->middleware('perm:system.coupons.index');
        Route::post('coupons', [CouponController::class, 'store'])->middleware('perm:system.coupons.store');
        Route::put('coupons/{id}', [CouponController::class, 'update'])->middleware('perm:system.coupons.update');
        Route::delete('coupons/{id}', [CouponController::class, 'destroy'])->middleware('perm:system.coupons.destroy');
        Route::post('coupons/{id}/toggle', [CouponController::class, 'toggle'])->middleware('perm:system.coupons.toggle');

        // Promotions
        Route::get('promotions', [PromotionController::class, 'index'])->middleware('perm:system.promotions.index');
        Route::post('promotions', [PromotionController::class, 'store'])->middleware('perm:system.promotions.store');
        Route::put('promotions/{id}', [PromotionController::class, 'update'])->middleware('perm:system.promotions.update');
        Route::delete('promotions/{id}', [PromotionController::class, 'destroy'])->middleware('perm:system.promotions.destroy');
        Route::post('promotions/{id}/toggle', [PromotionController::class, 'toggle'])->middleware('perm:system.promotions.toggle');

        // Nationalities
        Route::get('nationalities', [NationalityController::class, 'index'])->middleware('perm:system.nationalities.index');
        Route::post('nationalities', [NationalityController::class, 'store'])->middleware('perm:system.nationalities.store');
        Route::put('nationalities/{id}', [NationalityController::class, 'update'])->middleware('perm:system.nationalities.update');
        Route::delete('nationalities/{id}', [NationalityController::class, 'destroy'])->middleware('perm:system.nationalities.destroy');
        Route::post('nationalities/{id}/toggle', [NationalityController::class, 'toggle'])->middleware('perm:system.nationalities.toggle');
        Route::post('nationalities/{id}/translations', [NationalityController::class, 'upsertTranslation'])->middleware('perm:system.nationalities.translations');
    });

/*
|--------------------------------------------------------------------------
| Office Auth (public + protected with Sanctum)
|--------------------------------------------------------------------------
*/
Route::prefix('v1/office')->group(function () {
    // public
    Route::post('auth/register',        [AuthOfficeController::class, 'register']);
    Route::post('auth/login',           [AuthOfficeController::class, 'login']);
    Route::post('auth/forgot-password', [AuthOfficeController::class, 'forgot']);
    Route::post('auth/reset-password',  [AuthOfficeController::class, 'reset']);

    // protected
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('me',                 [AuthOfficeController::class, 'me']);
        Route::post('auth/logout',       [AuthOfficeController::class, 'logout']);

        // FCM tokens
        Route::post('fcm-tokens',        [FcmTokenController::class, 'store']);
        Route::delete('fcm-tokens',      [FcmTokenController::class, 'destroy']);

        // Subscriptions (office self)
        Route::get('plans',                   [SubscriptionController::class, 'plans']);
        Route::get('subscription',            [SubscriptionController::class, 'current']);
        Route::post('subscribe',              [SubscriptionController::class, 'subscribe']);
        Route::post('subscription/auto-renew',[SubscriptionController::class, 'autoRenew']);
    });
});
