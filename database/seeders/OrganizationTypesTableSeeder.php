<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Seeder;

class OrganizationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizationtype = [
            [
                 'title_ar' => 'شركة',
                'title_en' => 'organization',
            ],
            [
                'title_ar' => 'فرد',
               'title_en' => 'individual',
            ],
  
        ];
        foreach ($organizationtype as $organizationtyp) {
            OrganizationType::create($organizationtyp);
        }
    }
}
