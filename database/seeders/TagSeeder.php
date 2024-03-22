<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Tag::create([
                "name_ar" => "جديد",
                "name_en" => "new",
                "bg_color" => "#f05189",
            ]);

            Tag::create([
                "name_ar" => "حصري",
                "name_en" => "exclusive",
                "bg_color" => "#3ef1f4",
            ]);
    }
}
