<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    protected string $conn = 'system';

    public function run(): void
    {
        $db = DB::connection($this->conn);

        // parent categories
        $parents = [
            [
                'slug' => 'domestic-workers',
                'name' => 'Domestic Workers',
                'ar'   => 'العمالة المنزلية',
                'active' => 1,
                'children' => [
                    ['slug'=>'housemaid','name'=>'Housemaid','ar'=>'عاملة منزلية'],
                    ['slug'=>'nanny','name'=>'Nanny','ar'=>'مربية أطفال'],
                    ['slug'=>'cook','name'=>'Cook','ar'=>'طباخة'],
                ],
            ],
            [
                'slug' => 'maintenance',
                'name' => 'Maintenance',
                'ar'   => 'صيانة',
                'active' => 1,
                'children' => [
                    ['slug'=>'plumbing','name'=>'Plumbing','ar'=>'سباكة'],
                    ['slug'=>'electrical','name'=>'Electrical','ar'=>'كهرباء'],
                    ['slug'=>'cleaning','name'=>'Cleaning','ar'=>'تنظيف'],
                ],
            ],
        ];

        $now = now();

        // 1) insert/update parents
        $idBySlug = [];
        foreach ($parents as $p) {
            $db->table('categories')->updateOrInsert(
                ['slug' => $p['slug']],
                [
                    'parent_id'  => null,
                    'slug'       => $p['slug'],
                    'name'       => $p['name'],
                    'active'     => (bool)$p['active'],
                    'meta'       => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                    'deleted_at' => null,
                ]
            );

            $parent = $db->table('categories')->where('slug', $p['slug'])->first();
            $idBySlug[$p['slug']] = $parent->id ?? null;

            // translations (en/ar)
            $this->upsertTranslation($parent->id, 'en', $p['name']);
            $this->upsertTranslation($parent->id, 'ar', $p['ar'] ?? $p['name']);

            // 2) children
            if (!empty($p['children'])) {
                foreach ($p['children'] as $c) {
                    $db->table('categories')->updateOrInsert(
                        ['slug' => $c['slug']],
                        [
                            'parent_id'  => $parent->id,
                            'slug'       => $c['slug'] ?: Str::slug($c['name']),
                            'name'       => $c['name'],
                            'active'     => 1,
                            'meta'       => null,
                            'created_at' => $now,
                            'updated_at' => $now,
                            'deleted_at' => null,
                        ]
                    );

                    $child = $db->table('categories')->where('slug', $c['slug'])->first();
                    $this->upsertTranslation($child->id, 'en', $c['name']);
                    $this->upsertTranslation($child->id, 'ar', $c['ar'] ?? $c['name']);
                }
            }
        }
    }

    protected function upsertTranslation(int $categoryId, string $lang, string $name): void
    {
        DB::connection($this->conn)->table('category_translations')->updateOrInsert(
            ['category_id' => $categoryId, 'lang_code' => $lang],
            ['name' => $name, 'created_at'=> now(), 'updated_at'=> now(), 'deleted_at'=> null]
        );
    }
}
