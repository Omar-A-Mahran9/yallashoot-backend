<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Brand::create([
        //     "name_ar" => "مرسيدس",
        //     "name_en" => "mercedes",
        //     "image" => "webstdy_1647941351trade mark.svg",
        //     "cover" => "webstdy_1647941351mercedes-background.jpg",
        //     "meta_keyword_ar" => "مرسيدس",
        //     "meta_keyword_en" => "mercedes",
        //     "meta_desc_en" => "mercedes",
        //     "meta_desc_ar" => "مرسيدس",
        //     "car_available_types" => "new",
        // ]);

        // Brand::create([
        //     "name_ar" => "بي ام دبليو",
        //     "name_en" => "BMW",
        //     "image" => "webstdy_1647943401bmw_trade_mark.svg",
        //     "cover" => "webstdy_1647943401bmw_background.jpg",
        //     "meta_keyword_ar" => "bmw",
        //     "meta_keyword_en" => "bmw",
        //     "meta_desc_en" => "bmw",
        //     "meta_desc_ar" => "bmw",
        //     "car_available_types" => "new",
        // ]);
    }
}
