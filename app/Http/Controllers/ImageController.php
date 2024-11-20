<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{

    public function cropImage(Request $request)
    {
        // Pastikan Anda sudah memiliki file gambar (upload atau path lokal)
        $file = $request->file('image');

        // Baca gambar dari file
        $image = Image::make($file);

        // Crop gambar (misalnya, dari titik (x=100, y=100), lebar=200, tinggi=200)
        $image->crop(200, 200, 100, 100);

        // Simpan hasil crop ke folder tertentu
        $path = public_path('images/cropped_image.jpg');
        $image->save($path);

        return response()->json(['message' => 'Image cropped successfully!', 'path' => $path]);
    }

}
