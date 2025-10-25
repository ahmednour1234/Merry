<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class CvResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'office_id'        => $this->office_id,
            'category_id'      => $this->category_id,
            'nationality_code' => $this->nationality_code,
            'gender'           => $this->gender,
            'has_experience'   => (bool)$this->has_experience,

            'file' => [
                'path'      => $this->file_path,
                'mime'      => $this->file_mime,
                'size'      => $this->file_size,
                'original'  => $this->file_original_name,
                'url'       => $this->when($this->file_path, fn() => \Illuminate\Support\Facades\Storage::disk('public')->url($this->file_path)),
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
