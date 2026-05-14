<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

// Static pages
Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/privacy', fn () => view('pages.privacy'))->name('privacy');
Route::get('/terms', fn () => view('pages.terms'))->name('terms');
Route::get('/security', fn () => view('pages.security'))->name('security');

// Contact page + form submission
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/docs/postman.json', function () {
    $path = storage_path('app/private/scribe/collection.json');
    abort_unless(is_file($path), 404, 'Postman collection not found');
    return response()->file($path, ['Content-Type' => 'application/json']);
});

/**
 * Serve public storage files through PHP.
 * Bypasses symlink/server-permission issues entirely.
 */
Route::get('/storage/{path}', function (string $path) {
    $path = ltrim($path, '/');
    if (str_contains($path, '..')) {
        abort(403);
    }
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    $fullPath = Storage::disk('public')->path($path);
    $mime     = mime_content_type($fullPath) ?: 'application/octet-stream';
    return response()->file($fullPath, [
        'Content-Type'  => $mime,
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('path', '.*');

