<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageManager
{
    public static function uploadImage($image, $dir)
    {
        if ($image != null) {

            $fileName   = 'Book-your-dine-'.time() . '-' . uniqid(). '.' .$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $fileName, file_get_contents($image));

            return $dir . $fileName;
        }
    }

    public static function removeImage($image)
    {
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
        return [
            'success' => 1,
            'message' => 'Removed successfully !'
        ];
    }

    public static function updateImage($oldImage, $newImage, $dir)
    {
        if (Storage::disk('public')->exists($oldImage ?? '-')) {
            Storage::disk('public')->delete($oldImage);
        }
        $imageName = ImageManager::uploadImage($newImage, $dir);

        return $imageName;

    }

}
