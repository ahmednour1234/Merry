<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a temporary signed URL for a public storage file.
     * Expires after 24 hours. Format:
     *   https://mery.alemtayaz.com/public/storage/offices/file.png?expires=...&signature=...
     *
     * Files are served through the Laravel web route (PHP),
     * bypassing symlink/permission issues entirely.
     */
    function storage_url(string $path): string
    {
        return \Illuminate\Support\Facades\URL::temporarySignedRoute(
            'public.storage',
            now()->addHours(24),
            ['path' => ltrim($path, '/')]
        );
    }
}
