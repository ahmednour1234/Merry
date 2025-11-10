<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CvResource extends JsonResource
{
    public function toArray($request): array
    {
        // قراءة اللغة من الهيدر
        $lang = strtolower($request->header('Accept-Language', 'en'));

        // استخراج الترجمة الصحيحة إن وُجدت
        $nationalityName = null;
        if ($this->relationLoaded('nationality') && $this->nationality) {
            $translation = $this->nationality->translations
                ->firstWhere('lang_code', $lang);

            $nationalityName = $translation->name
                ?? $this->nationality->name
                ?? null;
        }

        return [
            'id'               => $this->id,
            'office_id'        => $this->office_id,
            'category_id'      => $this->category_id,

            'nationality' => [
                'code' => $this->nationality_code,
                'name' => $nationalityName,
            ],

            'gender'           => $this->gender,
            'has_experience'   => (bool) $this->has_experience,
            'is_muslim'        => (bool) $this->is_muslim,

            'file' => [
                'path'      => $this->file_path,
                'mime'      => $this->file_mime,
                'size'      => $this->file_size,
                'original'  => $this->file_original_name,
                'url'       => $this->when(
                    $this->file_path,
                    fn() => Storage::disk('public')->url($this->file_path)
                ),
            ],

            'status'           => $this->status,
            'approved_by'      => $this->approved_by,
            'approved_at'      => optional($this->approved_at)->toIso8601String(),
            'rejected_by'      => $this->rejected_by,
            'rejected_at'      => optional($this->rejected_at)->toIso8601String(),
            'rejected_reason'  => $this->rejected_reason,
            'frozen_by'        => $this->frozen_by,
            'frozen_at'        => optional($this->frozen_at)->toIso8601String(),
            'deactivated_by_office_at' => optional($this->deactivated_by_office_at)->toIso8601String(),

            'created_at'       => optional($this->created_at)->toIso8601String(),
            'updated_at'       => optional($this->updated_at)->toIso8601String(),
            'deleted_at'       => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}
