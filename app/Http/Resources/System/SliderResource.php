<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
	public function toArray($request): array
	{
		/** @var \App\Services\LocaleService $locale */
		$locale = app(\App\Services\LocaleService::class);
		$preferred = $locale->preferred($request);
		$short = strtolower(explode('-', $preferred)[0]);

		$title = null;
		$text  = null;
		if ($this->relationLoaded('translations')) {
			$full = $this->translations->first(function ($t) use ($preferred) {
				$code = str_replace('_', '-', $t->lang_code);
				if (str_contains($code, '-')) {
					[$l,$r] = explode('-', $code, 2);
					$code = strtolower($l) . '-' . strtoupper($r);
				} else {
					$code = strtolower($code);
				}
				return $code === $preferred;
			});
			$sh = $full ? null : $this->translations->first(function ($t) use ($short) {
				$c = strtolower(explode('-', str_replace('_','-',$t->lang_code))[0]);
				return $c === $short;
			});
			$tr = $full ?: $sh;
			if ($tr) {
				$title = $tr->title;
				$text  = $tr->text;
			}
		}

		$image = $this->image;
		if ($image && !str_starts_with($image, 'http')) {
			$image = asset('storage/' . ltrim($image, '/'));
		}

		return [
			'id'       => $this->id,
			'image'    => $image,
			'link_url' => $this->link_url,
			'position' => (int) $this->position,
			'active'   => (bool) $this->active,
			'title'    => $title,
			'text'     => $text,
			'meta'     => $this->meta,
			'created_at' => optional($this->created_at)->toIso8601String(),
			'updated_at' => optional($this->updated_at)->toIso8601String(),
			'deleted_at' => optional($this->deleted_at)->toIso8601String(),
		];
	}
}


