<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationalities = [
            [
                'id' => 1,
                'name_ar' => 'سعودي',
                'name_en' => 'ٍsaudi',
            
            ],
            [
                'id' => 2,
                'name_ar' => 'مقيم',
                'name_en' => 'ٍresident',
            
            ],
            [
                'id' => 3,
                'name_ar' => 'قبائل نازحة',
                'name_en' => 'ٍDisplaced tribes',
            
            ],
        ];

        foreach ($nationalities as $nationality)
        {
            Nationality::create($nationality);
        }
    }
}
