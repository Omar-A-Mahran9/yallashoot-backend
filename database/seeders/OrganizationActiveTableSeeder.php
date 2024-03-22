<?php

namespace Database\Seeders;

use App\Models\Organizationactive;
use Illuminate\Database\Seeder;

class OrganizationActiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizationactives = [
            [
                'title_ar' => 'تجارية',
                'title_en' => 'Commercial',
            ],
            [
                'title_ar' => 'مقاولات',
               'title_en' => 'Construction',
            ],
            [
                'title_ar' => 'أغذية',
               'title_en' => 'foods',
            ],
            [
                'title_ar' => 'تأجير سيارات',
               'title_en' => 'Cars Rent',
            ],
            [
                'title_ar' => 'أخرى',
                 'title_en' => 'etc',
            ],
  
        ];
        foreach ($organizationactives as $organizationactive) {
            Organizationactive::create($organizationactive);
        }
    }
}
