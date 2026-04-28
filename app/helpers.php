<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a standard /storage/{path} URL.
     * Strips any trailing /public from APP_URL (shared-hosting artefact)
     * so the URL is always correct regardless of server configuration.
     *
     * Files are served through the web /storage/{path} PHP route,
     * bypassing symlink/permission issues entirely.
     *
     * e.g. APP_URL=https://mery.alemtayaz.com/public
     *   storage_url('offices/file.png')
     *   -> https://mery.alemtayaz.com/storage/offices/file.png
     */
    function storage_url(string $path): string
    {
        // Use APP_URL as-is — it already includes /public on this server
        // so the result is: https://mery.alemtayaz.com/public/storage/offices/file.png
        $base = rtrim((string) config('app.url'), '/');

        return $base . '/storage/' . ltrim($path, '/');
    }
}
