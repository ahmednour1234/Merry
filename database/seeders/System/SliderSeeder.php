<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SliderSeeder extends Seeder
{
	public function run(): void
	{
		$db = DB::connection('system');
		if (!Schema::connection('system')->hasTable('sliders')) {
			return;
		}
		$now = now();

		$rows = [
			[
				'image' => 'https://picsum.photos/seed/slider1/1200/400',
				'link_url' => 'https://example.com/offer-1',
				'position' => 1,
				'active' => 1,
			],
			[
				'image' => 'https://picsum.photos/seed/slider2/1200/400',
				'link_url' => 'https://example.com/offer-2',
				'position' => 2,
				'active' => 1,
			],
		];

		foreach ($rows as $row) {
			$id = $db->table('sliders')->insertGetId([
				'image' => $row['image'],
				'link_url' => $row['link_url'],
				'position' => $row['position'],
				'active' => $row['active'],
				'meta' => null,
				'created_at' => $now,
				'updated_at' => $now,
				'deleted_at' => null,
			]);

			// translations
			if (Schema::connection('system')->hasTable('slider_translations')) {
				$db->table('slider_translations')->updateOrInsert(
					['slider_id' => $id, 'lang_code' => 'en'],
					['title' => 'Welcome', 'text' => 'Enjoy our latest offers', 'created_at'=>$now, 'updated_at'=>$now]
				);
				$db->table('slider_translations')->updateOrInsert(
					['slider_id' => $id, 'lang_code' => 'ar'],
					['title' => 'مرحبا', 'text' => 'استمتع بأحدث عروضنا', 'created_at'=>$now, 'updated_at'=>$now]
				);
			}
		}
	}
}


