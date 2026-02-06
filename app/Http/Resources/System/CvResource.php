<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CvResource extends JsonResource
{
    public function toArray($request): array
    {
		$isBooked = false;
		try {
			$user = $request->user();
			if ($user && $user instanceof \App\Models\Identity\EndUser) {
				$isBooked = \App\Models\CvBooking::on('system')
					->where('cv_id', $this->id)
					->where('end_user_id', (int) $user->id)
					->whereIn('status', \App\Enums\BookingStatus::activeStatuses())
					->exists();
			}
		} catch (\Throwable $e) {
			$isBooked = false;
		}

        return [
            'id'               => $this->id,
            'office_id'        => $this->office_id,
            'category_id'      => $this->category_id,
			'is_booked'        => $isBooked,

            // الجنسية (مبنية على Accept-Language + translations)
            'nationality'      => NationalityResource::make(
                $this->whenLoaded('nationality')
            ),

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
					fn () => asset('storage/' . ltrim($this->file_path, '/'))
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
