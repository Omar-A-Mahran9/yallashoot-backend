<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Sector;
class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_ar' => 'خاص',
                'name_en' => 'private',
                'slug' => Str::slug('private', '_'),
            ],
            [
                'name_ar' => 'حكومي مدني',
                'name_en' => 'civil governmental',
                'slug' => Str::slug('civil governmental', '_'),
            ],
            [
                'name_ar' => 'حكومي عسكري',
                'name_en' => 'Military government',
                'slug' => Str::slug('Military government', '_'),
            ],
            [
                'name_ar' => 'متقاعد',
                'name_en' => 'retired',
                'slug' => Str::slug('retired', '_'),
            ],
  

        ];

        foreach($data as $record){
            Sector::create([
                'name_ar' => $record['name_ar'],
                'name_en' => $record['name_en'],
                'slug' => $record['slug'],
            ]);
        }
    }
}
