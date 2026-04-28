<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a public URL for a stored file served through the Laravel API.
     * No symlink required — works regardless of APP_URL configuration.
     *
     * e.g. storage_url('offices/file.png')
     *   → https://mery.alemtayaz.com/public/api/v1/public/files/offices/file.png
     */
    function storage_url(string $path): string
    {
        return route('public.file', ['path' => ltrim($path, '/')]);
    }
}
