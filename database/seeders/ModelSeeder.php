<?php

namespace Database\Seeders;

use App\Models\CarModel;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $numberOfModels=10;
        // for ($i = 1; $i <= $numberOfModels; $i++) {
        //     DB::table('models')->insert([
        //         "name_ar" => "S500".$i,
        //         "name_en" => "S500".$i,
        //         "meta_keyword_ar" => "S500".$i,
        //         "meta_keyword_en" => "S500".$i,
        //         "meta_desc_ar" => "S500".$i,
        //         "meta_desc_en" => "S500".$i,
        //         "brand_id" => 1,            ]);
        // }
 
    }
}
