<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    public function toArray($request): array
    {
        // اختيار اللغة من Accept-Language أو من system_settings(app.locale) (اختياري)
        $accept = $request->header('Accept-Language');
        $lang = $accept ? explode(',', $accept)[0] : null;

        $name = $this->name;
        if ($lang && $this->relationLoaded('translations')) {
            $tr = $this->translations->firstWhere('lang_code', $lang);
            if ($tr) $name = $tr->name;
        }

        return [
            'id'     => $this->id,
            'code'   => $this->code,
            'active' => (bool)$this->active,
            'translations' => $this->whenLoaded('translations', function () {
                return $this->translations->mapWithKeys(fn($t) => [$t->lang_code => $t->name]);
            }),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
            'deleted_at' => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
