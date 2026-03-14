<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/docs/postman.json', function () {
    $path = storage_path('app/private/scribe/collection.json');
    abort_unless(is_file($path), 404, 'Postman collection not found');
    return response()->file($path, ['Content-Type' => 'application/json']);
});

Route::prefix('office')->middleware(['auth:office-panel'])->group(function () {
    Route::get('/subscriptions', [\App\Http\Controllers\Office\SubscriptionController::class, 'index'])->name('office.subscriptions');
    Route::post('/subscriptions/subscribe', [\App\Http\Controllers\Office\SubscriptionController::class, 'subscribe'])->name('office.subscriptions.subscribe');
    Route::post('/subscriptions/{id}/toggle-auto-renew', [\App\Http\Controllers\Office\SubscriptionController::class, 'toggleAutoRenew'])->name('office.subscriptions.toggle-auto-renew');
    Route::post('/subscriptions/{id}/cancel', [\App\Http\Controllers\Office\SubscriptionController::class, 'cancel'])->name('office.subscriptions.cancel');
    Route::post('/subscriptions/{id}/renew', [\App\Http\Controllers\Office\SubscriptionController::class, 'renew'])->name('office.subscriptions.renew');

    Route::get('/cvs/{id}/download', function ($id) {
        $cv = \App\Models\Cv::on('system')->findOrFail($id);
        $office = auth()->guard('office-panel')->user();

        if ($cv->office_id !== $office->id) {
            abort(403);
        }

        if (empty($cv->file_path)) {
            abort(404, 'File not found');
        }

        // Try multiple possible paths
        $possiblePaths = [
            \Illuminate\Support\Facades\Storage::disk('public')->path($cv->file_path),
            public_path('storage/' . ltrim($cv->file_path, '/')),
            storage_path('app/public/' . ltrim($cv->file_path, '/')),
        ];

        $filePath = null;
        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                $filePath = $path;
                break;
            }
        }

        if (!$filePath) {
            abort(404, 'File not found');
        }

        $fileName = $cv->file_original_name ?? basename($cv->file_path);

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    })->name('office.cvs.download');
});
