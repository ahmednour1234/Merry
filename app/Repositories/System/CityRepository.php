<?php

namespace App\Repositories\System;

use App\Models\City;
use App\Models\CityTranslation;
use App\Repositories\System\Contracts\CityRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CityRepository implements CityRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = City::on('system')->with('translations')->orderBy('id');

        if (!empty($filters['country'])) $q->where('country_code', strtoupper($filters['country']));
        if (isset($filters['active']))   $q->where('active', (bool)$filters['active']);
        if (!empty($filters['from']))    $q->where('created_at', '>=', $filters['from']);
        if (!empty($filters['to']))      $q->where('created_at', '<=', $filters['to']);
        if (!empty($filters['q'])) {
            $term = '%'.$filters['q'].'%';
            $q->whereIn('id', function ($w) use ($term) {
                $w->select('city_id')->from('city_translations')->where('name','like',$term);
            });
        }

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function store(array $data): City
    {
        return DB::connection('system')->transaction(function () use ($data) {
            $slug = $data['slug'] ?? Str::slug($data['name_en'] ?? $data['name_ar'] ?? Str::uuid());
            $city = City::on('system')->create([
                'slug'         => $slug,
                'country_code' => strtoupper($data['country_code'] ?? 'SA'),
                'active'       => (bool)($data['active'] ?? true),
            ]);

            $translations = $data['translations'] ?? [];
            foreach ($translations as $lang => $name) {
                CityTranslation::on('system')->updateOrCreate(
                    ['city_id'=>$city->id,'lang_code'=>$lang],
                    ['name'=>$name]
                );
            }

            return $city->load('translations');
        });
    }

    public function update(int $id, array $data): ?City
    {
        return DB::connection('system')->transaction(function () use ($id, $data) {
            $city = City::on('system')->find($id);
            if (!$city) return null;

            if (isset($data['slug']))         $city->slug = $data['slug'];
            if (isset($data['country_code'])) $city->country_code = strtoupper($data['country_code']);
            if (isset($data['active']))       $city->active = (bool)$data['active'];
            $city->save();

            if (array_key_exists('translations', $data)) {
                $translations = $data['translations'] ?? [];
                foreach ($translations as $lang => $name) {
                    CityTranslation::on('system')->updateOrCreate(
                        ['city_id'=>$city->id,'lang_code'=>$lang],
                        ['name'=>$name]
                    );
                }
            }

            return $city->load('translations');
        });
    }

    public function destroy(int $id): bool
    {
        $city = City::on('system')->find($id);
        return $city ? (bool)$city->delete() : false;
    }

    public function toggle(int $id, bool $active): ?City
    {
        $city = City::on('system')->find($id);
        if (!$city) return null;
        $city->active = $active; $city->save();
        return $city;
    }
}
