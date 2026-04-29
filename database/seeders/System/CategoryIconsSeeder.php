<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryIconsSeeder extends Seeder
{
    protected string $conn = 'system';

    /**
     * Clear any placeholder icon paths so no broken URLs are returned.
     * Upload real icons through the Filament admin panel → الفئات → تعديل → الأيقونة / الصورة
     * or via API: POST /api/v1/admin/system/categories/{id}/icon
     */
    public function run(): void
    {
        DB::connection($this->conn)
            ->table('categories')
            ->whereNull('deleted_at')
            ->update([
                'icon'       => null,
                'updated_at' => now(),
            ]);

        $this->command->info('Category icons cleared. Upload real icons via the admin panel.');
    }
}
