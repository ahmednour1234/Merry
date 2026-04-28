<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a signed temporary URL for a public storage file.
     * Returns a URL with ?expires=...&signature=... query params.
     * Files are served through the Laravel API — no symlink required.
     *
     * e.g. storage_url('offices/file.png')
     *   → https://mery.alemtayaz.com/public/api/v1/public/files/offices/file.png?expires=...&signature=...
     */
    function storage_url(string $path): string
    {
        return \Illuminate\Support\Facades\URL::temporarySignedRoute(
            'public.file',
            now()->addHours(24),
            ['path' => ltrim($path, '/')]
        );
    }
}
