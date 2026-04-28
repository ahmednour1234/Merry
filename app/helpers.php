<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a public storage URL served through the Laravel API file route.
     * Uses /api/v1/public/files/{path} so the request goes through index.php,
     * bypassing Apache symlink 403 errors entirely — no symlink needed.
     *
     * e.g. APP_URL=https://mery.alemtayaz.com/public
     *   storage_url('offices/file.png')
     *   -> https://mery.alemtayaz.com/public/api/v1/public/files/offices/file.png
     */
    function storage_url(string $path): string
    {
        $base = rtrim((string) config('app.url'), '/');
        return $base . '/api/v1/public/files/' . ltrim($path, '/');
    }
}

if (!function_exists('storage_signed_url')) {
    /**
     * Generate a signed file URL via the public API file-serving endpoint.
     * Signs only (path + expires) with the app key — avoids APP_URL path
     * mismatch that breaks Laravel's built-in URL::signedRoute().
     *
     * e.g. storage_signed_url('cvs/file.pdf', 3600)
     *   -> https://mery.alemtayaz.com/public/api/v1/public/files/cvs/file.pdf
     *      ?expires=1777402616&signature=abc123...
     */
    function storage_signed_url(string $path, int $ttlSeconds = 3600): string
    {
        $path    = ltrim($path, '/');
        $expires = time() + $ttlSeconds;
        $secret  = (string) config('app.key');

        // Strip the 'base64:' prefix Laravel uses in .env
        if (str_starts_with($secret, 'base64:')) {
            $secret = base64_decode(substr($secret, 7));
        }

        $signature = hash_hmac('sha256', $path . '|' . $expires, $secret);
        $base      = rtrim((string) config('app.url'), '/');

        return $base . '/api/v1/public/files/' . $path
            . '?expires=' . $expires . '&signature=' . $signature;
    }
}

if (!function_exists('verify_storage_signature')) {
    /**
     * Verify a signature produced by storage_signed_url().
     * Returns false if the URL is expired or the signature does not match.
     */
    function verify_storage_signature(string $path, int $expires, string $signature): bool
    {
        if (time() > $expires) {
            return false;
        }

        $secret = (string) config('app.key');

        if (str_starts_with($secret, 'base64:')) {
            $secret = base64_decode(substr($secret, 7));
        }

        $expected = hash_hmac('sha256', ltrim($path, '/') . '|' . $expires, $secret);

        return hash_equals($expected, $signature);
    }
}
