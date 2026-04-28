<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a public storage URL served through the Laravel API route.
     * This bypasses any symlink/permission issues on the server entirely.
     *
     * e.g. storage_url('offices/file.png')
     *   → https://mery.alemtayaz.com/public/api/v1/public/files/offices/file.png
     */
    function storage_url(string $path): string
    {
        $base = rtrim((string) config('app.url'), '/');
        return $base . '/api/v1/public/files/' . ltrim($path, '/');
    }
}
