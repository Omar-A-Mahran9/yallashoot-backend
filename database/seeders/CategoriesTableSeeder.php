<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $numberOfCategories = 10;

        // for ($i = 1; $i <= $numberOfCategories; $i++) {
        //     DB::table('categories')->insert([
        //         'name_ar' => 'Category Name AR ' . $i,
        //         'name_en' => 'Category Name EN ' . $i,
        //         'model_id'=>1,
        //         'meta_keyword_ar' => 'Meta Keyword AR ' . $i,
        //         'meta_keyword_en' => 'Meta Keyword EN ' . $i,
        //         'meta_desc_ar' => 'Meta Description AR ' . $i,
        //         'meta_desc_en' => 'Meta Description EN ' . $i,
        //         'model_id' => $i, // Assuming model_id corresponds to the model you want to associate with
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
