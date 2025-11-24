<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        $accept = $request->header('Accept-Language');
        $lang = $accept ? explode(',', $accept)[0] : null;

        $name = $this->name;
        if ($lang && $this->relationLoaded('translations')) {
            $tr = $this->translations->firstWhere('lang_code', $lang);
            if ($tr) $name = $tr->name;
        }

        return [
            'id'        => $this->id,
            'parent_id' => $this->parent_id,
            'slug'      => $this->slug,
            'name'      => $name,
            'active'    => (bool)$this->active,
            'children_count' => $this->when(isset($this->children_count), $this->children_count),
            'translations' => $this->whenLoaded('translations', function () {
                return $this->translations->mapWithKeys(fn($t) => [$t->lang_code => $t->name]);
            }),
            'created_at'=> optional($this->created_at)->toIso8601String(),
            'updated_at'=> optional($this->updated_at)->toIso8601String(),
            'deleted_at'=> optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
