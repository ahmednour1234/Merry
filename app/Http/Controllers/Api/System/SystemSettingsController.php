<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Services\SystemSettings;
use Illuminate\Http\Request;

class SystemSettingsController extends ApiController
{
	public function __construct(protected SystemSettings $settings)
	{
		parent::__construct(app('api.responder'));
	}

	/**
	 * GET /v1/admin/system/settings?scope=global|null
	 * يعرض الإعدادات حسب الـ scope (أو الكل لو scope=null)
	 */
	public function index(Request $r)
	{
		$scope = $r->query('scope', 'global');
		if ($scope === 'null') {
			$scope = null;
		}
		$list = $this->settings->all($scope);
		return $this->responder->ok($list, 'Settings list');
	}

	/**
	 * PUT /v1/admin/system/settings/{key}
	 * body: { value: mixed, scope?: string, type?: "string"|"json" }
	 */
	public function update(Request $r, string $key)
	{
		$data = $r->validate([
			'value' => 'required',
			'scope' => 'sometimes|string|max:100',
			'type'  => 'sometimes|string|in:string,json',
		]);

		$scope = $data['scope'] ?? 'global';
		$type  = $data['type']  ?? null;
		$ok    = $this->settings->put($key, $data['value'], $scope, $type);

		if (!$ok) {
			return $this->responder->fail('Failed to update setting', status: 500);
		}

		// Special handling: if app.locale changed, reflect immediately
		if ($key === 'app.locale' && is_string($data['value'])) {
			app()->setLocale($data['value']);
			config(['app.locale' => $data['value']]);
		}

		return $this->responder->ok(null, 'Setting updated');
	}
}


