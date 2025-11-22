<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Set error handler to catch fatal errors
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
        // Check if this is an API request
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        $isApi = (strpos($uri, '/api/') === 0) || (strpos($accept, 'application/json') !== false);
        
        if ($isApi) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Fatal error: ' . $error['message'],
                'file' => $error['file'],
                'line' => $error['line'],
                'type' => $error['type'],
            ], JSON_PRETTY_PRINT);
        }
    }
});

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

try {
    // Bootstrap Laravel and handle the request...
    /** @var Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    // Catch any errors during bootstrap
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    $isApi = (strpos($uri, '/api/') === 0) || (strpos($accept, 'application/json') !== false);
    
    if ($isApi) {
        header('Content-Type: application/json');
        http_response_code(500);
        $debug = (bool) env('APP_DEBUG', false);
        echo json_encode([
            'success' => false,
            'message' => $debug ? $e->getMessage() : 'Application bootstrap error',
            'exception' => $debug ? get_class($e) : null,
            'file' => $debug ? $e->getFile() : null,
            'line' => $debug ? $e->getLine() : null,
            'trace' => $debug ? explode("\n", $e->getTraceAsString()) : null,
        ], JSON_PRETTY_PRINT);
    } else {
        // For non-API requests, let Laravel handle it
        throw $e;
    }
}
