<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\EndUser\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group Public / Pages
     * Show a public page by slug
     * @urlParam slug string required The page key. Example: privacy
     * @queryParam lang string Optional language code (ar, en, ar-SA)
     */
    public function show(Request $request, string $slug)
    {
        $page = Page::on('system')
            ->where('slug', $slug)
            ->where('active', true)
            ->with('translations')
            ->first();

        if (!$page) {
            return $this->responder->fail('Page not found', status:404);
        }

        return $this->responder->ok(new PageResource($page), 'Page');
    }
}


