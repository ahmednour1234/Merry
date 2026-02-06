<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Services\SystemSettings;
use Illuminate\Http\Request;

class PublicSettingsController extends ApiController
{
	public function __construct(protected SystemSettings $settings)
	{
		parent::__construct(app('api.responder'));
	}

	/**
	 * GET /api/v1/settings
	 * Public settings for frontend (contact, brand, links)
	 * @group Public
	 */
	public function index(Request $request)
	{
		$email   = (string) $this->settings->get('app.contact.email', '', 'global');
		$phone   = (string) $this->settings->get('app.contact.phone', '', 'global');
		$logo    = (string) $this->settings->get('app.brand.logo', '', 'global');
		$website = (string) $this->settings->get('app.links.website', '', 'global');
		$social  = (array)  $this->settings->get('app.links.social', [], 'global');

		$logoUrl = $logo;
		if ($logoUrl && !str_starts_with($logoUrl, 'http')) {
			$logoUrl = asset('storage/' . ltrim($logoUrl, '/'));
		}

		return $this->responder->ok([
			'contact' => [
				'email' => $email,
				'phone' => $phone,
			],
			'brand' => [
				'logo' => $logoUrl,
			],
			'links' => [
				'website' => $website,
				'social'  => $social,
			],
		], 'Public settings');
	}
}


