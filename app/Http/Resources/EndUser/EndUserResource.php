<?php

namespace App\Http\Resources\EndUser;

use App\Http\Resources\System\CityResource;
use App\Http\Resources\System\NationalityResource;
use App\Models\City;
use App\Models\Nationality;
use Illuminate\Http\Resources\Json\JsonResource;

class EndUserResource extends JsonResource
{
    public function toArray($request): array
    {
        $city = null;
		$nationality = null;

        if ($this->city_id) {
            $cityModel = City::on('system')->with('translations')->find($this->city_id);
            if ($cityModel) {
                $city = new CityResource($cityModel);
            }
        }

		// Use country_id as nationality id (system connection), include translations
		if ($this->country_id) {
			$natModel = Nationality::on('system')->with('translations')->find($this->country_id);
			if ($natModel) {
				$nationality = new NationalityResource($natModel);
			}
		}

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'national_id' => $this->national_id,
            'city' => $city,
			'nationality' => $nationality,
            'bio' => $this->bio,
            'active' => (bool) $this->active,
            'avatar' => $this->avatar_path,
            'avatar_url' => $this->avatar_url,
            'last_login_at' => optional($this->last_login_at)->toIso8601String(),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
            'deleted_at' => optional($this->deleted_at)->toIso8601String(),
        ];
    }
}


