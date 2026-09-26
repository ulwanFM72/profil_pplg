<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /** Simpan gambar ke disk public; diperkecil & dikonversi ke WEBP bila GD tersedia. */
    public function store(UploadedFile $file, string $dir, int $maxWidth = 1600): string
    {
        $img = function_exists('imagewebp') ? @imagecreatefromstring(file_get_contents($file->getRealPath())) : false;

        if (! $img) {
            return $file->store($dir, 'public');
        }

        if (imagesx($img) > $maxWidth) {
            $img = imagescale($img, $maxWidth);
        }
        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);

        ob_start();
        imagewebp($img, null, 82);
        $data = ob_get_clean();

        $path = $dir.'/'.Str::uuid().'.webp';
        Storage::disk('public')->put($path, $data);

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
