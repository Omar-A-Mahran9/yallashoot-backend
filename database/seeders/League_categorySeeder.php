<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class League_categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name_ar' => 'محلي', 'name_en' => 'Local'],
            ['name_ar' => 'عالمي', 'name_en' => 'Global'],
            ['name_ar' => 'آسيوي', 'name_en' => 'Asian'],
            ['name_ar' => 'أوروبي', 'name_en' => 'European'],
            ['name_ar' => 'أفريقي', 'name_en' => 'African'],
            ['name_ar' => 'دولي', 'name_en' => 'International'],
            ['name_ar' => 'قاري', 'name_en' => 'Continental'],        ];

        // Insert the categories into the database
        foreach ($categories as $category) {
            DB::table('league_categories')->insert($category);
        }
    }
}
