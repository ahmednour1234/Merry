<?php

namespace App\Repositories\System;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Repositories\System\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Category::on('system')
            ->with(['translations'])
            ->withCount('children')
            ->orderBy('name');

        if (!empty($filters['q'])) {
            $q->where(function($w) use ($filters) {
                $w->where('name','like','%'.$filters['q'].'%')
                  ->orWhere('slug','like','%'.$filters['q'].'%');
            });
        }
        if (isset($filters['active'])) $q->where('active', (bool)$filters['active']);
        if (!empty($filters['parent_id'])) $q->where('parent_id', (int)$filters['parent_id']);
        if (!empty($filters['from'])) $q->where('created_at','>=',$filters['from']);
        if (!empty($filters['to']))   $q->where('created_at','<=',$filters['to']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function store(array $data): Category
    {
        $tr = $data['translations'] ?? null;
        unset($data['translations']);

        $row = Category::on('system')->create($data);

        if ($tr) {
            foreach ($tr as $t) {
                CategoryTranslation::on('system')->updateOrCreate(
                    ['category_id'=>$row->id, 'lang_code'=>$t['lang_code']],
                    ['name'=>$t['name']]
                );
            }
        }

        return $row->fresh(['translations'])->loadCount('children');
    }

    public function update(int $id, array $data): ?Category
    {
        $row = Category::on('system')->find($id);
        if (!$row) return null;

        $tr = $data['translations'] ?? null;
        unset($data['translations']);

        $row->fill($data)->save();

        if (is_array($tr)) {
            foreach ($tr as $t) {
                CategoryTranslation::on('system')->updateOrCreate(
                    ['category_id'=>$row->id, 'lang_code'=>$t['lang_code']],
                    ['name'=>$t['name']]
                );
            }
        }

        return $row->fresh(['translations'])->loadCount('children');
    }

    public function destroy(int $id): bool
    {
        $row = Category::on('system')->find($id);
        return $row ? (bool)$row->delete() : false;
    }

    public function toggle(int $id, bool $active): ?Category
    {
        $row = Category::on('system')->find($id);
        if (!$row) return null;
        $row->active = $active;
        $row->save();
        return $row->loadCount('children');
    }

    public function upsertTranslation(int $id, string $lang, string $name): bool
    {
        $row = Category::on('system')->find($id);
        if (!$row) return false;

        CategoryTranslation::on('system')->updateOrCreate(
            ['category_id'=>$row->id, 'lang_code'=>$lang],
            ['name'=>$name]
        );
        return true;
    }
}
