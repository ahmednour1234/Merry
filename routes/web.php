<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs/postman.json', function () {
    $path = storage_path('app/private/scribe/collection.json');
    abort_unless(is_file($path), 404, 'Postman collection not found');
    return response()->file($path, ['Content-Type' => 'application/json']);
});

/**
 * Public storage file serving — no auth required.
 * Handles any path under /storage/* so files are accessible
 * regardless of how APP_URL is configured on the server.
 */
Route::get('/storage/{path}', function (string $path) {
    // Prevent path traversal
    $path = ltrim($path, '/');
    if (str_contains($path, '..')) {
        abort(403);
    }

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $fullPath  = Storage::disk('public')->path($path);
    $mimeType  = mime_content_type($fullPath) ?: 'application/octet-stream';

    return response()->file($fullPath, [
        'Content-Type'  => $mimeType,
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('path', '.*');

