<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\PageResource;
use App\Models\Page;
use App\Models\PageTranslation;
use Illuminate\Http\Request;

class PageController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * List pages
     * @queryParam title string Search by title. Example: About
     * @queryParam slug string Filter by slug. Example: about-us
     * @queryParam active boolean Filter by active. Example: 1
     * @queryParam from date Example: 2025-01-01
     * @queryParam to date Example: 2025-12-31
     * @queryParam per_page integer Example: 15
     */
    public function index(Request $r)
    {
        $q = Page::on('system')->orderBy('title');

        // Optionally load translations if requested
        if ($r->boolean('with_translations', false)) {
            $q->with('translations');
        }

        if ($r->filled('title')) {
            $q->where('title', 'like', '%' . $r->title . '%');
        }
        if ($r->filled('slug')) {
            $q->where('slug', $r->slug);
        }
        if ($r->filled('active')) {
            $q->where('active', (bool)$r->boolean('active'));
        }
        if ($r->filled('from')) {
            $q->where('created_at', '>=', $r->date('from'));
        }
        if ($r->filled('to')) {
            $q->where('created_at', '<=', $r->date('to'));
        }

        $per = (int)$r->integer('per_page', 15);
        $p = $q->paginate($per > 0 ? $per : 15)->appends($r->query());

        return $this->responder->paginated($p, PageResource::class, 'Pages');
    }

    /**
     * Show single page by ID or slug
     * @urlParam id integer required The page ID or slug
     */
    public function show($id)
    {
        $page = Page::on('system')
            ->with('translations')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if (!$page) {
            return $this->responder->fail('Page not found', status: 404);
        }

        return $this->responder->ok(new PageResource($page), 'Page retrieved');
    }

    /**
     * Create page
     * @bodyParam title string required Example: About Us
     * @bodyParam slug string required Example: about-us
     * @bodyParam content text Example: Page content here
     * @bodyParam meta_title string Example: About Us - Meta Title
     * @bodyParam meta_description text Example: Meta description
     * @bodyParam active boolean Example: 1
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('system.pages', 'slug')],
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'translations' => 'nullable|array',
            'translations.*.lang_code' => 'required|string|max:12',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
        ]);

        $page = Page::on('system')->create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'] ?? null,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'active' => (bool)($data['active'] ?? true),
        ]);

        // Handle translations if provided
        if (isset($data['translations']) && is_array($data['translations'])) {
            foreach ($data['translations'] as $translation) {
                PageTranslation::on('system')->create([
                    'page_id' => $page->id,
                    'lang_code' => $translation['lang_code'],
                    'title' => $translation['title'],
                    'content' => $translation['content'] ?? null,
                    'meta_title' => $translation['meta_title'] ?? null,
                    'meta_description' => $translation['meta_description'] ?? null,
                ]);
            }
        }

        $page->load('translations');
        return $this->responder->created(new PageResource($page), 'Page created');
    }

    /**
     * Update page
     * @urlParam id integer required
     * @bodyParam title string Example: About Us
     * @bodyParam slug string Example: about-us
     * @bodyParam content text Example: Page content here
     * @bodyParam meta_title string Example: About Us - Meta Title
     * @bodyParam meta_description text Example: Meta description
     * @bodyParam active boolean Example: 1
     */
    public function update(Request $r, $id)
    {
        $page = Page::on('system')->find($id);
        if (!$page) {
            return $this->responder->fail('Page not found', status: 404);
        }

        $data = $r->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => ['sometimes', 'string', 'max:255', \Illuminate\Validation\Rule::unique('system.pages', 'slug')->ignore($id)],
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'translations' => 'nullable|array',
            'translations.*.lang_code' => 'required|string|max:12',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
        ]);

        $page->fill($data)->save();

        // Handle translations if provided
        if (isset($data['translations']) && is_array($data['translations'])) {
            foreach ($data['translations'] as $translation) {
                PageTranslation::on('system')->updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'lang_code' => $translation['lang_code'],
                    ],
                    [
                        'title' => $translation['title'],
                        'content' => $translation['content'] ?? null,
                        'meta_title' => $translation['meta_title'] ?? null,
                        'meta_description' => $translation['meta_description'] ?? null,
                    ]
                );
            }
        }

        $page->load('translations');
        return $this->responder->ok(new PageResource($page), 'Page updated');
    }

    /**
     * Toggle page active status
     * @urlParam id integer required
     * @bodyParam active boolean required Example: 1
     */
    public function toggle(Request $r, $id)
    {
        $data = $r->validate(['active' => 'required|boolean']);
        $page = Page::on('system')->find($id);
        if (!$page) {
            return $this->responder->fail('Page not found', status: 404);
        }
        $page->active = $data['active'];
        $page->save();

        return $this->responder->ok(new PageResource($page), 'Page status updated');
    }

    /**
	 * Delete page
	 * @urlParam id integer required
     */
	public function destroy($id)
    {
        $page = Page::on('system')->find($id);
        if (!$page) {
            return $this->responder->fail('Page not found', status: 404);
        }
		$page->delete();

		return $this->responder->ok(null, 'Page deleted');
    }
}
