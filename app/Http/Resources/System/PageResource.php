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

        // Read language from Accept-Language header (e.g., ar, ar-SA, en-US)
        $accept = $request->header('Accept-Language');
        $lang = $accept ? explode(',', $accept)[0] : null;   // First language
        if ($lang && str_contains($lang, '-')) {
            $lang = explode('-', $lang)[0];                  // Convert en-US -> en
        }
        $lang = $lang ? strtolower($lang) : null;

        // Default values from page table
        $title = $this->title;
        $content = $this->content;
        $metaTitle = $this->meta_title;
        $metaDescription = $this->meta_description;

        // If translations are loaded, try to get by lang_code
        if ($lang && $this->relationLoaded('translations')) {
            $tr = $this->translations->firstWhere('lang_code', $lang);
            if ($tr) {
                $title = $tr->title;
                $content = $tr->content;
                $metaTitle = $tr->meta_title;
                $metaDescription = $tr->meta_description;
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

