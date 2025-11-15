<?php

namespace App\Http\Resources\EndUser;

use App\Http\Resources\System\CityResource;
use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

class EndUserResource extends JsonResource
{
    public function toArray($request): array
    {
        $city = null;

        if ($this->city_id) {
            $cityModel = City::on('system')->with('translations')->find($this->city_id);
            if ($cityModel) {
                $city = new CityResource($cityModel);
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'city' => $city,
            'bio' => $this->bio,
            'active' => (bool) $this->active,
            'avatar' => $this->avatar_path,
            'avatar_url' => $this->avatar_url,
            'last_login_at' => optional($this->last_login_at)->toIso8601String(),
            'email_verified_at' => optional($this->email_verified_at)->toIso8601String(),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
            'deleted_at' => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}


