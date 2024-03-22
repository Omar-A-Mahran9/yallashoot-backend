<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    use HasFactory;
    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];
    protected $append=['full_image_path'];
    protected $fillable=[
        "car_id",
        "image"
    ];


    public static function handleProductImages($carID)
    {
       

        $deletedImages = json_decode(request()->deleted_images ?? "[]");
        // dd($deletedImages);
        $newProductImages = request()->car_Images ?? [];
        foreach ($newProductImages as $imageFile) {
            $cat=CarImage::create([
                'car_id' => $carID,
                'image' => uploadImageToDirectory($imageFile, 'Cars'),
            ]);
 
        }
        /** remove deleted product images from storage folder**/
        foreach ($deletedImages as $imageName) {
            deleteImageFromDirectory($imageName, 'Cars');
            CarImage::where('car_id', $carID)->where('image', $imageName)->delete();
        //    $car=Car::where('id',$carID)
        }
    }

}
