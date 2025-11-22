<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');
        if (!$db->getSchemaBuilder()->hasTable('pages')) return;

        $now = now();
        $pages = [
            ['slug' => 'about',   'active' => 1],
            ['slug' => 'privacy', 'active' => 1],
            ['slug' => 'policy',  'active' => 1], // terms/policy
        ];

        foreach ($pages as $p) {
            $pageId = $db->table('pages')->updateOrInsert(
                ['slug' => $p['slug']],
                ['active' => (int)$p['active'], 'meta' => null, 'updated_at'=>$now, 'created_at'=>$now, 'deleted_at'=>null]
            );

            // Seed minimal translations if table exists
            if ($db->getSchemaBuilder()->hasTable('page_translations')) {
                $id = $db->table('pages')->where('slug', $p['slug'])->value('id');
                foreach (['en' => ucfirst($p['slug']), 'ar' => $this->arabicTitle($p['slug'])] as $lang => $title) {
                    $db->table('page_translations')->updateOrInsert(
                        ['page_id'=>$id,'lang_code'=>$lang],
                        ['title'=>$title,'content'=>null,'updated_at'=>$now,'created_at'=>$now,'deleted_at'=>null]
                    );
                }
            }
        }
    }

    protected function arabicTitle(string $slug): string
    {
        return match ($slug) {
            'about'   => 'من نحن',
            'privacy' => 'سياسة الخصوصية',
            'policy'  => 'الشروط والسياسة',
            default   => ucfirst($slug),
        };
    }
}


