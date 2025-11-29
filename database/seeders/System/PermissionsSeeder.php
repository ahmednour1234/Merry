<?php
// database/seeders/System/PermissionsSeeder.php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // نشتغل على اتصال system فقط لو جدول permissions موجود
        $db = DB::connection('system');
        if (!Schema::connection('system')->hasTable('permissions')) {
            return;
        }

        $now = now();

        $perms = [
            // ------- عامة -------
            ['slug'=>'system.read',                     'name'=>'System Read',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.manage',                   'name'=>'System Manage',                    'guard'=>'api','active'=>1],

            // ------- languages -------
            ['slug'=>'system.languages.index',         'name'=>'List Languages',                   'guard'=>'api','active'=>1],
            ['slug'=>'system.languages.store',         'name'=>'Store Language',                   'guard'=>'api','active'=>1],

            // ------- currencies -------
            ['slug'=>'system.currencies.index',        'name'=>'List Currencies',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.store',        'name'=>'Store Currency',                   'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.update',       'name'=>'Update Currency',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.destroy',      'name'=>'Delete Currency',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.toggle',       'name'=>'Toggle Currency',                  'guard'=>'api','active'=>1],

            // ------- exchange rates -------
            ['slug'=>'system.exchange_rates.index',    'name'=>'List Exchange Rates',              'guard'=>'api','active'=>1],
            ['slug'=>'system.exchange_rates.store',    'name'=>'Store Exchange Rate',              'guard'=>'api','active'=>1],
            ['slug'=>'system.exchange_rates.toggle',   'name'=>'Toggle Exchange Rate',             'guard'=>'api','active'=>1],

            // ------- users -------
            ['slug'=>'system.users.index',             'name'=>'List Users',                       'guard'=>'api','active'=>1],
            ['slug'=>'system.users.store',             'name'=>'Store User',                       'guard'=>'api','active'=>1],
            ['slug'=>'system.users.update',            'name'=>'Update User',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.users.destroy',           'name'=>'Delete User',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.users.toggle',            'name'=>'Toggle User',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.users.sync_roles',        'name'=>'Sync User Roles',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.users.sync_permissions',  'name'=>'Sync User Permissions',            'guard'=>'api','active'=>1],

            // ------- roles -------
            ['slug'=>'system.roles.index',             'name'=>'List Roles',                       'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.store',             'name'=>'Store Role',                       'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.update',            'name'=>'Update Role',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.destroy',           'name'=>'Delete Role',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.toggle',            'name'=>'Toggle Role',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.sync_permissions',  'name'=>'Sync Role Permissions',            'guard'=>'api','active'=>1],

            // ------- permissions -------
            ['slug'=>'system.permissions.index',       'name'=>'List Permissions',                 'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.store',       'name'=>'Store Permission',                 'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.update',      'name'=>'Update Permission',                'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.destroy',     'name'=>'Delete Permission',                'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.toggle',      'name'=>'Toggle Permission',                'guard'=>'api','active'=>1],

            // ------- audit logs (read only) -------
            ['slug'=>'system.audit_logs.index',        'name'=>'List Audit Logs',                  'guard'=>'api','active'=>1],

            // ------- insurance companies -------
            ['slug'=>'system.insurance_companies.index',  'name'=>'List Insurance Companies',     'guard'=>'api','active'=>1],
            ['slug'=>'system.insurance_companies.store',  'name'=>'Store Insurance Company',      'guard'=>'api','active'=>1],
            ['slug'=>'system.insurance_companies.update', 'name'=>'Update Insurance Company',     'guard'=>'api','active'=>1],
            ['slug'=>'system.insurance_companies.destroy','name'=>'Delete Insurance Company',     'guard'=>'api','active'=>1],
            ['slug'=>'system.insurance_companies.toggle', 'name'=>'Toggle Insurance Company',     'guard'=>'api','active'=>1],

            // ------- cities -------
            ['slug'=>'system.cities.index',            'name'=>'List Cities',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.cities.store',            'name'=>'Store City',                       'guard'=>'api','active'=>1],
            ['slug'=>'system.cities.update',           'name'=>'Update City',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.cities.destroy',          'name'=>'Delete City',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.cities.toggle',           'name'=>'Toggle City',                      'guard'=>'api','active'=>1],

            // ------- offices -------
            ['slug'=>'system.offices.index',           'name'=>'List Offices',                     'guard'=>'api','active'=>1],
            ['slug'=>'system.offices.store',           'name'=>'Store Office',                     'guard'=>'api','active'=>1],
            ['slug'=>'system.offices.update',          'name'=>'Update Office',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.offices.block',           'name'=>'Block/Unblock Office',             'guard'=>'api','active'=>1],
            ['slug'=>'system.offices.toggle',          'name'=>'Toggle Office',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.offices.destroy',         'name'=>'Delete Office',                    'guard'=>'api','active'=>1],

            // ------- plans -------
            ['slug'=>'system.plans.index',             'name'=>'List Plans',                       'guard'=>'api','active'=>1],
            ['slug'=>'system.plans.store',             'name'=>'Create Plan',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.plans.update',            'name'=>'Update Plan',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.plans.destroy',           'name'=>'Delete Plan',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.plans.toggle',            'name'=>'Toggle Plan',                      'guard'=>'api','active'=>1],
            ['slug'=>'system.plans.translations',      'name'=>'Plan Translations',                'guard'=>'api','active'=>1],
            ['slug'=>'system.plans.features',          'name'=>'Plan Features',                    'guard'=>'api','active'=>1],

            // ------- coupons -------
            ['slug'=>'system.coupons.index',           'name'=>'List Coupons',                     'guard'=>'api','active'=>1],
            ['slug'=>'system.coupons.store',           'name'=>'Create Coupon',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.coupons.update',          'name'=>'Update Coupon',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.coupons.destroy',         'name'=>'Delete Coupon',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.coupons.toggle',          'name'=>'Toggle Coupon',                    'guard'=>'api','active'=>1],

            // ------- promotions -------
            ['slug'=>'system.promotions.index',        'name'=>'List Promotions',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.promotions.store',        'name'=>'Create Promotion',                 'guard'=>'api','active'=>1],
            ['slug'=>'system.promotions.update',       'name'=>'Update Promotion',                 'guard'=>'api','active'=>1],
            ['slug'=>'system.promotions.destroy',      'name'=>'Delete Promotion',                 'guard'=>'api','active'=>1],
            ['slug'=>'system.promotions.toggle',       'name'=>'Toggle Promotion',                 'guard'=>'api','active'=>1],

            // ------- nationalities -------
            ['slug'=>'system.nationalities.index',        'name'=>'List Nationalities',           'guard'=>'api','active'=>1],
            ['slug'=>'system.nationalities.store',        'name'=>'Store Nationality',            'guard'=>'api','active'=>1],
            ['slug'=>'system.nationalities.update',       'name'=>'Update Nationality',           'guard'=>'api','active'=>1],
            ['slug'=>'system.nationalities.destroy',      'name'=>'Delete Nationality',           'guard'=>'api','active'=>1],
            ['slug'=>'system.nationalities.toggle',       'name'=>'Toggle Nationality',           'guard'=>'api','active'=>1],
            ['slug'=>'system.nationalities.translations', 'name'=>'Upsert Nationality Translations','guard'=>'api','active'=>1],

            // ------- categories -------
            ['slug'=>'system.categories.index',        'name'=>'List Categories',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.categories.store',        'name'=>'Store Category',                   'guard'=>'api','active'=>1],
            ['slug'=>'system.categories.update',       'name'=>'Update Category',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.categories.destroy',      'name'=>'Delete Category',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.categories.toggle',       'name'=>'Toggle Category',                  'guard'=>'api','active'=>1],
            ['slug'=>'system.categories.translations', 'name'=>'Upsert Category Translations',     'guard'=>'api','active'=>1],

            // ------- CVs -------
            ['slug'=>'system.cvs.index',               'name'=>'List CVs',                         'guard'=>'api','active'=>1],
            ['slug'=>'system.cvs.destroy',             'name'=>'Delete CV',                        'guard'=>'api','active'=>1],
            ['slug'=>'system.cvs.approve',             'name'=>'Approve CV',                       'guard'=>'api','active'=>1],
            ['slug'=>'system.cvs.reject',              'name'=>'Reject CV',                        'guard'=>'api','active'=>1],
            ['slug'=>'system.cvs.freeze',              'name'=>'Freeze/Unfreeze CV',               'guard'=>'api','active'=>1],

            // ------- favourites cv (admin) -------
            ['slug'=>'system.favorites_cv.index',      'name'=>'List Favourites CV',               'guard'=>'api','active'=>1],
            ['slug'=>'system.favorites_cv.stats',      'name'=>'Favourites CV Stats',              'guard'=>'api','active'=>1],

            // ------- sliders -------
            ['slug'=>'system.sliders.index',           'name'=>'List Sliders',                     'guard'=>'api','active'=>1],
            ['slug'=>'system.sliders.store',           'name'=>'Create Slider',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.sliders.update',          'name'=>'Update Slider',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.sliders.destroy',         'name'=>'Delete Slider',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.sliders.toggle',          'name'=>'Toggle Slider',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.sliders.translations',    'name'=>'Upsert Slider Translations',       'guard'=>'api','active'=>1],

            // ------- bookings -------
            ['slug'=>'system.bookings.index',          'name'=>'List Bookings',                    'guard'=>'api','active'=>1],
            ['slug'=>'system.bookings.stats',          'name'=>'Booking Stats',                    'guard'=>'api','active'=>1],

            // ------- analytics -------
            ['slug'=>'system.analytics.index',         'name'=>'System Analytics',                 'guard'=>'api','active'=>1],
        ];

        foreach ($perms as $p) {
            $db->table('permissions')->updateOrInsert(
                ['slug' => $p['slug'], 'guard' => $p['guard']],
                [
                    'name'       => $p['name'],
                    'active'     => (int)$p['active'],
                    'created_at' => $now,
                    'updated_at' => $now,
                    'deleted_at' => null, // لو عندك SoftDeletes على الجدول
                ]
            );
        }
    }
}
