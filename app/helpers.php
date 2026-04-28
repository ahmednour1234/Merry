<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a public storage URL that works correctly even when
     * APP_URL has a trailing /public segment (common in shared-hosting setups).
     *
     * e.g. APP_URL=https://example.com/public  →  https://example.com/storage/file.jpg
     */
    function storage_url(string $path): string
    {
        // Use STORAGE_URL env if explicitly set — highest priority.
        if ($storageUrl = env('STORAGE_URL')) {
            return rtrim($storageUrl, '/') . '/' . ltrim($path, '/');
        }

        // Strip a trailing /public from APP_URL (shared hosting artefact).
        $base = rtrim((string) config('app.url'), '/');
        $base = preg_replace('#/public$#i', '', $base);

        return $base . '/storage/' . ltrim($path, '/');
    }
}
