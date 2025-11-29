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

		// صورة العلم: مبدئياً من مكتبة أعلام (FlagCDN) حسب كود الجنسية، مع fallback من الداتابيس لو متاح
		$code = strtolower((string) $this->code);
		$libraryPng = $code !== '' ? "https://flagcdn.com/w80/{$code}.png" : null; // حجم صغير مناسب لـ FE
		$librarySvg = $code !== '' ? "https://flagcdn.com/{$code}.svg" : null;

		$dbImage = null;
		$meta = is_array($this->meta ?? null) ? $this->meta : [];
		if (!empty($meta)) {
			// جرّب مفاتيح شائعة داخل meta
			if (!empty($meta['image_url'])) {
				$dbImage = (string) $meta['image_url'];
			} elseif (!empty($meta['image'])) {
				$dbImage = (string) $meta['image'];
			} elseif (!empty($meta['image_path'])) {
				$dbImage = asset('storage/' . ltrim((string)$meta['image_path'], '/'));
			}
		}

		$image = $libraryPng ?: $dbImage;
		$imageSvg = $librarySvg; // لو حاب الـ FE يستخدم SVG

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
			'image'  => $image,
			'image_svg' => $imageSvg,
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
