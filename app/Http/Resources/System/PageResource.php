<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'      => $this->id,
            'slug'    => $this->slug,
            'active'  => (bool) $this->active,
            'meta'    => $this->meta,
            'translations' => $this->whenLoaded('translations', function () {
                return $this->translations->mapWithKeys(function ($t) {
                    return [$t->lang_code => ['title' => $t->title, 'content' => $t->content]];
                });
            }),
            'created_at'=> optional($this->created_at)->toIso8601String(),
            'updated_at'=> optional($this->updated_at)->toIso8601String(),
            'deleted_at'=> optional($this->deleted_at)->toIso8601String(),
        ];
    }
}


