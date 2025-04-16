<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function listImages()
    {
        return Image::where('user_id', Auth::id())->get();
    }

    public function uploadImage($file)
    {
        $path = $file->store('images', 'public');

        return Image::create([
            'user_id' => Auth::id(),
            'path' => $path
        ]);
    }

    public function deleteImage($id)
    {
        $image = Image::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        Storage::disk('public')->delete($image->path);
        $image->delete();

        return true;
    }
}
