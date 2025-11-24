<?php

namespace App\Support\Uploads;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploader
{
    /**
     * ارفع صورة على دسك public داخل مجلد $dir
     * @return string|null relative path مثل: insurance_companies/abc.jpg
     */
    public static function upload(?UploadedFile $file, string $dir, string $disk = 'public'): ?string
    {
        if (!$file) return null;

        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $name = Str::uuid()->toString().'.'.$ext;

        $path = trim($dir, '/').'/'.$name;
        Storage::disk($disk)->put($path, file_get_contents($file->getRealPath()));
        return $path;
    }

    public static function deleteIfExists(?string $path, string $disk = 'public'): void
    {
        if ($path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
