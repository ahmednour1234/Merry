<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
	public function handle(Request $request, Closure $next)
	{
		try {
			/** @var \App\Services\LocaleService $localeService */
			$localeService = app(\App\Services\LocaleService::class);
			$locale = $localeService->preferred($request);

			app()->setLocale($locale ?: 'ar');
			config(['app.locale' => $locale ?: 'ar']);
		} catch (\Throwable $e) {
			// لو حصل خطأ، سيب اللغة الافتراضية من config
		}

		return $next($request);
	}
}


