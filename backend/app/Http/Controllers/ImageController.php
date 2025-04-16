<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;

class ImageController extends Controller
{
    protected $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->listImages();
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $image = $this->service->uploadImage($request->file('image'));

        return response()->json($image, 201);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:images,id'
        ]);

        $this->service->deleteImage($request->id);

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
