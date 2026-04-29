<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryIconsSeeder extends Seeder
{
    protected string $conn = 'system';

    /**
     * Map each category slug → icon filename stored under storage/app/public/categories/icons/
     * Place the matching files there, or swap these for full URLs if using a remote disk.
     */
    protected array $icons = [
        // parents
        'domestic-workers' => 'categories/icons/domestic-workers.png',
        'maintenance'      => 'categories/icons/maintenance.png',

        // domestic-workers children
        'housemaid'        => 'categories/icons/housemaid.png',
        'nanny'            => 'categories/icons/nanny.png',
        'cook'             => 'categories/icons/cook.png',

        // maintenance children
        'plumbing'         => 'categories/icons/plumbing.png',
        'electrical'       => 'categories/icons/electrical.png',
        'cleaning'         => 'categories/icons/cleaning.png',
    ];

    public function run(): void
    {
        $db = DB::connection($this->conn);

        foreach ($this->icons as $slug => $iconPath) {
            $db->table('categories')
                ->where('slug', $slug)
                ->whereNull('deleted_at')
                ->update([
                    'icon'       => $iconPath,
                    'updated_at' => now(),
                ]);
        }

        $this->command->info('Category icons seeded successfully.');
    }
}
