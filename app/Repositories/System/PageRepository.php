<?php

namespace App\Repositories\System;

use App\Models\Page;
use App\Models\PageTranslation;
use App\Repositories\System\Contracts\PageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageRepository implements PageRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Page::on('system')->with('translations')->orderBy('id');

        if (isset($filters['active'])) $q->where('active', (bool)$filters['active']);
        if (!empty($filters['slug'])) $q->where('slug', $filters['slug']);
        if (!empty($filters['q'])) {
            $term = '%'.$filters['q'].'%';
            $q->whereIn('id', function ($w) use ($term) {
                $w->select('page_id')->from('page_translations')
                    ->where('title','like',$term)
                    ->orWhere('content','like',$term);
            });
        }

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function store(array $data): Page
    {
        return DB::connection('system')->transaction(function () use ($data) {
            $slug = $data['slug'] ?? Str::slug($data['title_en'] ?? $data['title_ar'] ?? Str::uuid());
            $page = Page::on('system')->create([
                'slug'   => $slug,
                'active' => (bool)($data['active'] ?? true),
                'meta'   => $data['meta'] ?? null,
            ]);

            $translations = $data['translations'] ?? [];
            foreach ($translations as $lang => $payload) {
                $payload = is_array($payload) ? $payload : ['title' => (string)$payload, 'content' => null];
                PageTranslation::on('system')->updateOrCreate(
                    ['page_id'=>$page->id,'lang_code'=>$lang],
                    ['title'=>$payload['title'] ?? '', 'content'=>$payload['content'] ?? null]
                );
            }

            return $page->load('translations');
        });
    }

    public function update(int $id, array $data): ?Page
    {
        return DB::connection('system')->transaction(function () use ($id, $data) {
            $page = Page::on('system')->find($id);
            if (!$page) return null;

            if (isset($data['slug']))   $page->slug = $data['slug'];
            if (isset($data['active'])) $page->active = (bool)$data['active'];
            if (array_key_exists('meta', $data)) $page->meta = $data['meta'];
            $page->save();

            if (array_key_exists('translations', $data)) {
                $translations = $data['translations'] ?? [];
                foreach ($translations as $lang => $payload) {
                    $payload = is_array($payload) ? $payload : ['title' => (string)$payload, 'content' => null];
                    PageTranslation::on('system')->updateOrCreate(
                        ['page_id'=>$page->id,'lang_code'=>$lang],
                        ['title'=>$payload['title'] ?? '', 'content'=>$payload['content'] ?? null]
                    );
                }
            }

            return $page->load('translations');
        });
    }

    public function destroy(int $id): bool
    {
        $page = Page::on('system')->find($id);
        return $page ? (bool)$page->delete() : false;
    }

    public function toggle(int $id, bool $active): ?Page
    {
        $page = Page::on('system')->find($id);
        if (!$page) return null;
        $page->active = $active; $page->save();
        return $page;
    }
}


