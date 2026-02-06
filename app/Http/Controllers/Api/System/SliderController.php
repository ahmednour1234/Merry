<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\SliderResource;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Support\Uploads\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends ApiController
{
	public function __construct()
	{
		parent::__construct(app('api.responder'));
	}

	/** List sliders */
	public function index(Request $r)
	{
		$q = Slider::on('system')->orderBy('position')->orderByDesc('created_at');
		if ($r->has('active')) $q->where('active', (bool) $r->boolean('active'));
		$per = max(1, (int) $r->integer('per_page', 15));
		$p = $q->with('translations')->paginate($per)->appends($r->query());
		return $this->responder->paginated($p, SliderResource::class, 'Sliders');
	}

	/** Create slider */
	public function store(Request $r)
	{
		$data = $r->validate([
			// Prefer file uploads; fallback to image_url string
			'image'    => ['sometimes','file','image','max:10240'],
			'image_url'=> ['sometimes','string','max:2048'],
			'link_url' => ['nullable','string','max:2048'],
			'position' => ['nullable','integer','min:0'],
			'active'   => ['nullable','boolean'],
			'translations' => ['nullable','array'],
			'translations.*.lang_code' => ['required','string','max:12'],
			'translations.*.title'     => ['nullable','string','max:255'],
			'translations.*.text'      => ['nullable','string'],
		]);

		$imagePath = null;
		if ($r->hasFile('image')) {
			$imagePath = ImageUploader::upload($r->file('image'), 'sliders');
		} elseif (!empty($data['image_url'])) {
			// Fetch external image and store locally to avoid hotlink 403 issues
			try {
				$response = Http::withHeaders([
					'User-Agent' => 'MeryBot/1.0',
					'Accept' => 'image/*,*/*;q=0.8',
				])->timeout(10)->get($data['image_url']);
				if ($response->successful()) {
					$ext = pathinfo(parse_url($data['image_url'], PHP_URL_PATH) ?? '', PATHINFO_EXTENSION) ?: 'jpg';
					$name = Str::uuid()->toString().'.'.strtolower($ext);
					$path = 'sliders/'.$name;
					Storage::disk('public')->put($path, $response->body());
					$imagePath = $path;
				} else {
					$imagePath = $data['image_url']; // fallback keep URL
				}
			} catch (\Throwable $e) {
				$imagePath = $data['image_url'];
			}
		}

		$row = Slider::on('system')->create([
			'image'    => $imagePath,
			'link_url' => $data['link_url'] ?? null,
			'position' => (int) ($data['position'] ?? 0),
			'active'   => (bool) ($data['active'] ?? true),
		]);

		if (!empty($data['translations']) && is_array($data['translations'])) {
			foreach ($data['translations'] as $t) {
				SliderTranslation::on('system')->create([
					'slider_id' => $row->id,
					'lang_code' => $t['lang_code'],
					'title'     => $t['title'] ?? null,
					'text'      => $t['text'] ?? null,
				]);
			}
		}

		$row->load('translations');
		return $this->responder->created(new SliderResource($row), 'Slider created');
	}

	/** Update slider */
	public function update(Request $r, int $id)
	{
		$row = Slider::on('system')->find($id);
		if (!$row) return $this->responder->fail('Slider not found', 404);

		$data = $r->validate([
			'image'    => ['sometimes','file','image','max:10240'],
			'image_url'=> ['sometimes','nullable','string','max:2048'],
			'link_url' => ['sometimes','nullable','string','max:2048'],
			'position' => ['sometimes','integer','min:0'],
			'active'   => ['sometimes','boolean'],
			'translations' => ['nullable','array'],
			'translations.*.lang_code' => ['required','string','max:12'],
			'translations.*.title'     => ['nullable','string','max:255'],
			'translations.*.text'      => ['nullable','string'],
		]);

		// Handle image updates first
		if ($r->hasFile('image')) {
			ImageUploader::deleteIfExists($row->image);
			$row->image = ImageUploader::upload($r->file('image'), 'sliders');
		} elseif (array_key_exists('image_url', $data)) {
			// Replace with locally cached copy of remote image when possible
			if (!empty($data['image_url'])) {
				try {
					$response = Http::withHeaders([
						'User-Agent' => 'MeryBot/1.0',
						'Accept' => 'image/*,*/*;q=0.8',
					])->timeout(10)->get($data['image_url']);
					if ($response->successful()) {
						ImageUploader::deleteIfExists($row->image);
						$ext = pathinfo(parse_url($data['image_url'], PHP_URL_PATH) ?? '', PATHINFO_EXTENSION) ?: 'jpg';
						$name = Str::uuid()->toString().'.'.strtolower($ext);
						$path = 'sliders/'.$name;
						Storage::disk('public')->put($path, $response->body());
						$row->image = $path;
					} else {
						$row->image = $data['image_url'];
					}
				} catch (\Throwable $e) {
					$row->image = $data['image_url'];
				}
			} else {
				$row->image = null;
			}
		}

		$row->fill([
			'link_url' => $data['link_url'] ?? $row->link_url,
			'position' => array_key_exists('position',$data) ? (int)$data['position'] : $row->position,
			'active'   => array_key_exists('active',$data) ? (bool)$data['active'] : $row->active,
		])->save();

		if (!empty($data['translations']) && is_array($data['translations'])) {
			foreach ($data['translations'] as $t) {
				SliderTranslation::on('system')->updateOrCreate(
					[
						'slider_id' => $row->id,
						'lang_code' => $t['lang_code'],
					],
					[
						'title' => $t['title'] ?? null,
						'text'  => $t['text'] ?? null,
					]
				);
			}
		}

		$row->load('translations');
		return $this->responder->ok(new SliderResource($row), 'Slider updated');
	}

	/** Toggle active */
	public function toggle(Request $r, int $id)
	{
		$data = $r->validate(['active' => ['required','boolean']]);
		$row = Slider::on('system')->find($id);
		if (!$row) return $this->responder->fail('Slider not found', 404);
		$row->active = (bool) $data['active'];
		$row->save();
		return $this->responder->ok(new SliderResource($row), 'Slider status updated');
	}

	/** Delete slider */
	public function destroy(int $id)
	{
		$row = Slider::on('system')->find($id);
		if (!$row) return $this->responder->fail('Slider not found', 404);
		$row->delete();
		return $this->responder->ok(null, 'Slider deleted');
	}

	/** Upsert translation */
	public function upsertTranslation(Request $r, int $id)
	{
		$row = Slider::on('system')->find($id);
		if (!$row) return $this->responder->fail('Slider not found', 404);

		$data = $r->validate([
			'lang_code' => ['required','string','max:12'],
			'title'     => ['nullable','string','max:255'],
			'text'      => ['nullable','string'],
		]);

		SliderTranslation::on('system')->updateOrCreate(
			['slider_id' => $row->id, 'lang_code' => $data['lang_code']],
			['title' => $data['title'] ?? null, 'text' => $data['text'] ?? null]
		);

		return $this->responder->ok(null, 'Translation saved');
	}
}


