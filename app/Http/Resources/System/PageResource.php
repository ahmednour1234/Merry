<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class PageResource extends JsonResource
{
    public function toArray($request): array
    {
        // If resource is MissingValue or null, return empty array
        if ($this->resource instanceof MissingValue || $this->resource === null) {
            return [];
        }

		/** @var \App\Services\LocaleService $localeService */
		$localeService = app(\App\Services\LocaleService::class);
		$preferred = $localeService->preferred($request); // e.g., ar, ar-SA
		$preferredShort = strtolower(explode('-', $preferred)[0]);

        // Default values from page table
        $title = $this->title;
        $content = $this->content;
        $metaTitle = $this->meta_title;
        $metaDescription = $this->meta_description;

		// If translations are loaded, try to pick best match:
		// 1) Full match (ar-SA), 2) Short match (ar), otherwise keep defaults
		if ($this->relationLoaded('translations')) {
			$full = $this->translations->first(function ($t) use ($preferred) {
				$code = $t->lang_code;
				// normalize both
				$norm = str_replace('_', '-', $code);
				if (str_contains($norm, '-')) {
					[$l, $r] = explode('-', $norm, 2);
					$norm = strtolower($l) . '-' . strtoupper($r);
				} else {
					$norm = strtolower($norm);
				}
				return $norm === $preferred;
			});

			$short = null;
			if (!$full) {
				$short = $this->translations->first(function ($t) use ($preferredShort) {
					$codeShort = strtolower(explode('-', str_replace('_', '-', $t->lang_code))[0]);
					return $codeShort === $preferredShort;
				});
			}

			$tr = $full ?: $short;
			if ($tr) {
				$title = $tr->title ?? $title;
				$content = $tr->content ?? $content;
				$metaTitle = $tr->meta_title ?? $metaTitle;
				$metaDescription = $tr->meta_description ?? $metaDescription;
			}
        }

        return [
            'id' => $this->id,
            'title' => $title,
            'slug' => $this->slug,
            'content' => $content,
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'active' => (bool) $this->active,

            // Return all translations if loaded (for admin panel use)
            'translations' => $this->whenLoaded('translations', function () {
                return $this->translations->map(function ($t) {
                    return [
                        'lang_code' => $t->lang_code,
                        'title' => $t->title,
                        'content' => $t->content,
                        'meta_title' => $t->meta_title,
                        'meta_description' => $t->meta_description,
                    ];
                })->keyBy('lang_code');
            }),

            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
            'deleted_at' => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}

