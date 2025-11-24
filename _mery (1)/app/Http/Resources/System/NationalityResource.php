<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class NationalityResource extends JsonResource
{
    public function toArray($request): array
    {
        // لو الـ resource أصلاً MissingValue أو null نرجّع مصفوفة فاضية
        if ($this->resource instanceof MissingValue || $this->resource === null) {
            return [];
        }

        // قراءة اللغة من Accept-Language (مثال: ar, ar-SA, en-US)
        $accept = $request->header('Accept-Language');
        $lang = $accept ? explode(',', $accept)[0] : null;   // أول لغة
        if ($lang && str_contains($lang, '-')) {
            $lang = explode('-', $lang)[0];                  // نحول en-US -> en
        }
        $lang = $lang ? strtolower($lang) : null;

        // الاسم الافتراضي من عمود name في nationalities
        $name = $this->name;

        // لو فيه translations محمّلة نحاول نجيب حسب lang_code
        if ($lang && $this->relationLoaded('translations')) {
            $tr = $this->translations->firstWhere('lang_code', $lang);
            if ($tr) {
                $name = $tr->name;
            }
        }

        return [
            'id'     => $this->id,
            'code'   => $this->code,
            'name'   => $name,
            'active' => (bool) $this->active,

            // نرجّع كل الترجمات لو محمّلة (للاستخدام في البانل مثلاً)
            'translations' => $this->whenLoaded('translations', function () {
                return $this->translations->mapWithKeys(
                    fn($t) => [$t->lang_code => $t->name]
                );
            }),

            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
            'deleted_at' => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
