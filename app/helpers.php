<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a public storage URL.
     * Uses APP_URL directly so the URL matches the server's domain.
     * Files are served through the Laravel /storage/{path} web route,
     * bypassing symlink/permission issues entirely.
     *
     * e.g. APP_URL=https://mery.alemtayaz.com/public
     *   storage_url('offices/file.png')
     *   -> https://mery.alemtayaz.com/public/storage/offices/file.png
     */
    function storage_url(string $path): string
    {
        $base = rtrim((string) config('app.url'), '/');
        return $base . '/storage/' . ltrim($path, '/');
    }
}
