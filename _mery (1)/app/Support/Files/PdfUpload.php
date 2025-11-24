<?php

namespace App\Support\Files;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PdfUpload
{
    public static function store(UploadedFile $file, string $dir = 'cvs'): array
    {
        // تأكيد PDF
        if ($file->getMimeType() !== 'application/pdf') {
            throw new \InvalidArgumentException('Only PDF is allowed');
        }

        $name = Str::uuid().'.pdf';
        $path = $file->storeAs($dir, $name, ['disk'=>'public']);

        return [
            'path'           => $path,
            'mime'           => $file->getMimeType(),
            'size'           => $file->getSize(),
            'original_name'  => $file->getClientOriginalName(),
        ];
    }
}
