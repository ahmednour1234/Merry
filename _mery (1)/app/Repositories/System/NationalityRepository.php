<?php

namespace App\Repositories\System;

use App\Models\Nationality;
use App\Models\NationalityTranslation;
use App\Repositories\System\Contracts\NationalityRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class NationalityRepository implements NationalityRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Nationality::on('system')->with('translations')->orderBy('name');

        if (!empty($filters['q']))      $q->where('name','like','%'.$filters['q'].'%')->orWhere('code','like','%'.$filters['q'].'%');
        if (isset($filters['active']))  $q->where('active', (bool)$filters['active']);
        if (!empty($filters['from']))   $q->where('created_at','>=',$filters['from']);
        if (!empty($filters['to']))     $q->where('created_at','<=',$filters['to']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function all(array $filters = []): Collection
    {
        $q = Nationality::on('system')->with('translations')->orderBy('name');
        if (isset($filters['active'])) $q->where('active',(bool)$filters['active']);
        return $q->get();
    }

    public function store(array $data): Nationality
    {
        $tr = $data['translations'] ?? null;
        unset($data['translations']);

        $row = Nationality::on('system')->create($data);

        if ($tr) {
            foreach ($tr as $t) {
                NationalityTranslation::on('system')->updateOrCreate(
                    ['nationality_id'=>$row->id, 'lang_code'=>$t['lang_code']],
                    ['name'=>$t['name']]
                );
            }
        }

        return $row->fresh(['translations']);
    }

    public function update(int $id, array $data): ?Nationality
    {
        $row = Nationality::on('system')->find($id);
        if (!$row) return null;

        $tr = $data['translations'] ?? null;
        unset($data['translations']);

        $row->fill($data)->save();

        if (is_array($tr)) {
            foreach ($tr as $t) {
                NationalityTranslation::on('system')->updateOrCreate(
                    ['nationality_id'=>$row->id, 'lang_code'=>$t['lang_code']],
                    ['name'=>$t['name']]
                );
            }
        }

        return $row->fresh(['translations']);
    }

    public function destroy(int $id): bool
    {
        $row = Nationality::on('system')->find($id);
        return $row ? (bool)$row->delete() : false;
    }

    public function toggle(int $id, bool $active): ?Nationality
    {
        $row = Nationality::on('system')->find($id);
        if (!$row) return null;
        $row->active = $active;
        $row->save();
        return $row;
    }

    public function upsertTranslation(int $id, string $lang, string $name): bool
    {
        $row = Nationality::on('system')->find($id);
        if (!$row) return false;

        NationalityTranslation::on('system')->updateOrCreate(
            ['nationality_id'=>$row->id, 'lang_code'=>$lang],
            ['name'=>$name]
        );
        return true;
    }
}
