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
			['scope'=>'global','key'=>'app.contact.email','value'=>'support@example.com','type'=>'string'],
			['scope'=>'global','key'=>'app.contact.phone','value'=>'+1 555-0100','type'=>'string'],
			['scope'=>'global','key'=>'app.brand.logo','value'=>'/branding/logo.png','type'=>'string'],
			['scope'=>'global','key'=>'app.links.website','value'=>'https://example.com','type'=>'string'],
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
		foreach ($rows as $r) {
			$db->table('system_settings')->updateOrInsert(
				['scope'=>$r['scope'],'key'=>$r['key']],
				['value'=>$r['value'],'type'=>$r['type'],'created_at'=>$now,'updated_at'=>$now]
			);
		}
	}
}
