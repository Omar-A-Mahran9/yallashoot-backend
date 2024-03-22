<?php

namespace Database\Seeders;

use App\Enums\CarStatus;
use App\Models\City;
use DB;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $numberOfCars = 10;

        // for ($i = 0; $i < $numberOfCars; $i++) {
        //     DB::table('cars')->insert([
        //         'name_ar' => 'Car Name AR ' . $i,
        //         'name_en' => 'Car Name EN ' . $i,
        //         'price' => rand(10000, 50000), // Adjust the price range
        //         'discount_price' => rand(5000, 20000), // Adjust the discount price range
        //         'have_discount' => rand(0, 1),
        //         'is_duplicate' => rand(0, 1),
        //         'is_new'=>rand(0, 1),
        //         'gear_shifter'=>['automatic', 'manual'][array_rand(['automatic', 'manual'])],
        //         'video_url' => 'https://www.example.com/video' . $i,
        //         'fuel_type'=>['gasoline', 'diesel', 'electric', 'hybrid'][array_rand(['gasoline', 'diesel', 'electric', 'hybrid'])],
        //         'vendor_id'=>$i+1,
        //         'city_id'=>1,
        //         'brand_id'=>1,
        //         'model_id'=>1,
        //         'color_id'=>1,
        //         'category_id'=>$i+1,
        //         'year'=>2023,
        //         'status' => CarStatus::approved->value,
        //         'description_ar' => 'Description AR ' . $i,
        //         'description_en' => 'Description EN ' . $i,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         // ...
        //     ]);


            
        // }
    }
}
