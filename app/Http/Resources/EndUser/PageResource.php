<?php

namespace App\Http\Resources\EndUser;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray($request): array
    {
        // pick best translation by Accept-Language or ?lang=
        $preferred = $request->query('lang') ?: $request->header('X-Locale') ?: $request->header('Accept-Language');
        $preferred = is_string($preferred) ? trim(explode(',', $preferred)[0]) : null;

        $title = null;
        $content = null;
        $langUsed = null;

        if ($this->relationLoaded('translations') && $this->translations->count() > 0) {
            if ($preferred) {
                $wanted = strtolower(str_replace('_','-', $preferred));
                $wantedShort = explode('-', $wanted)[0];
                $full = $this->translations->first(function ($t) use ($wanted) {
                    return strtolower(str_replace('_','-',$t->lang_code)) === $wanted;
                });
                if ($full) {
                    $title = $full->title; $content = $full->content; $langUsed = $full->lang_code;
                } else {
                    $short = $this->translations->first(function ($t) use ($wantedShort) {
                        return strtolower(explode('-', $t->lang_code)[0]) === $wantedShort;
                    });
                    if ($short) {
                        $title = $short->title; $content = $short->content; $langUsed = $short->lang_code;
                    }
                }
            }
            if ($title === null) {
                $any = $this->translations->first();
                $title = $any?->title; $content = $any?->content; $langUsed = $any?->lang_code;
            }
        }

        return [
            'slug'   => $this->slug,
            'title'  => $title,
            'content'=> $content,
            'lang'   => $langUsed,
        ];
    }
}


