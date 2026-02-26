<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SystemSettingsSeeder extends Seeder
{
	public function run(): void
	{
		if (!Schema::connection('system')->hasTable('system_settings')) {
			return;
		}

		$now = now();
		$rows = [
			// Store everything as JSON (table likely enforces JSON_VALID(value))
			['scope'=>'global','key'=>'app.contact.email','value'=>json_encode('support@example.com', JSON_UNESCAPED_UNICODE),'type'=>'json'],
			['scope'=>'global','key'=>'app.contact.phone','value'=>json_encode('+1 555-0100', JSON_UNESCAPED_UNICODE),'type'=>'json'],
			['scope'=>'global','key'=>'app.brand.logo','value'=>json_encode('/branding/logo.png', JSON_UNESCAPED_UNICODE),'type'=>'json'],
			['scope'=>'global','key'=>'app.links.website','value'=>json_encode('https://example.com', JSON_UNESCAPED_UNICODE),'type'=>'json'],
            [
                'scope' => 'global',
                'key'   => 'app.name',
                'value' => json_encode('Merry'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'app.locale',
                'value' => json_encode('ar'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'app.fallback_locale',
                'value' => json_encode('en'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'app.timezone',
                'value' => json_encode('Africa/Cairo'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'currency.default',
                'value' => json_encode('SAR'),
                'type'  => 'string',
                'active'=> 1,
            ],
			['scope'=>'global','key'=>'app.links.social','value'=>json_encode([
				'facebook' => 'https://facebook.com/example',
				'instagram'=> 'https://instagram.com/example',
				'x'        => 'https://x.com/example',
				'linkedin' => 'https://linkedin.com/company/example',
				'tiktok'   => 'https://tiktok.com/@example',
				'youtube'  => 'https://youtube.com/@example',
				'whatsapp' => 'https://wa.me/15550100',
				'telegram' => 'https://t.me/example',
			], JSON_UNESCAPED_UNICODE),'type'=>'json'],
		];

		$db = DB::connection('system');
		$hasActive = Schema::connection('system')->hasColumn('system_settings', 'active');
		foreach ($rows as $r) {
			$db->table('system_settings')->updateOrInsert(
				['scope'=>$r['scope'],'key'=>$r['key']],
				$hasActive
					? ['value'=>$r['value'],'type'=>$r['type'],'active'=>1,'created_at'=>$now,'updated_at'=>$now]
					: ['value'=>$r['value'],'type'=>$r['type'],'created_at'=>$now,'updated_at'=>$now]
			);
		}
	}
}
