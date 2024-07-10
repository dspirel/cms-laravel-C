<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Image{

    public static function upload(?UploadedFile $image, string $folder, ?string $oldPath = null): string
    {
        if ($oldPath) {
            self::delete($oldPath);
        }

        $imagePath = $image->store($folder, 'public');

        return $imagePath;
    }

    public static function get(?string $path): string
    {
        if (!$path) {
            return "https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=";
        }

        return asset("storage/{$path}");
    }

    public static function delete(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
