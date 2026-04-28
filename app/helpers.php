<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a public storage URL that works correctly even when
     * APP_URL has a trailing /public segment (common in shared-hosting setups).
     *
     * Files are served through the /storage/{path} Laravel route,
     * so no symlink or APP_URL configuration is needed on the server.
     */
    function storage_url(string $path): string
    {
        // Strip trailing /public from APP_URL (shared-hosting artefact)
        $base = rtrim((string) config('app.url'), '/');
        $base = preg_replace('#/public$#i', '', $base);

        return $base . '/storage/' . ltrim($path, '/');
    }
}
