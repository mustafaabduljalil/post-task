<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImageService
{
    /**
     * Store image
     *
     * @return string
     */
    public function uploadImage($image, $dir){
        return Storage::disk(Post::STORAGE_DISK)->put($dir, $image);
    }
}
