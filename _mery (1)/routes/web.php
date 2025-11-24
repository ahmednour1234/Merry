<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/docs/postman.json', function () {
    $path = storage_path('app/private/scribe/collection.json');
    abort_unless(is_file($path), 404, 'Postman collection not found');
    return response()->file($path, ['Content-Type' => 'application/json']);
});
