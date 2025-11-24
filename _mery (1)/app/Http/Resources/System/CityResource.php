<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var \App\Services\LocaleService $locale */
        $locale = app(\App\Services\LocaleService::class);

        // الأفضل نضمن أن translations محمّلة من الكنترولر:
        // $p->getCollection()->load('translations');
        $selected = $this->relationLoaded('translations')
            ? $locale->pickNameFromTranslations($this->translations, $locale->preferred($request))
            : ['name' => null, 'lang' => null];

        return [
            'id'           => $this->id,
            'slug'         => $this->slug,
            'country_code' => $this->country_code,
            'active'       => (bool)$this->active,

            // الاسم المختار على حسب Accept-Language/X-Locale مع fallback إعدادات النظام
            'name'         => $selected['name'],
            'name_lang'    => $selected['lang'],

            // تقدر تحتفظ بكل الترجمات (لو محملة) لمَن يحتاجها في الـ FE
            'translations' => $this->whenLoaded('translations', function () {
                return $this->translations->mapWithKeys(fn($t) => [$t->lang_code => $t->name]);
            }),

            'created_at'   => optional($this->created_at)->toIso8601String(),
            'updated_at'   => optional($this->updated_at)->toIso8601String(),
            'deleted_at'   => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
