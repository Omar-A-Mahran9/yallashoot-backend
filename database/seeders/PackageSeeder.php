<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'id' => 1,
                'name_ar' => 'افراد',
                'name_en' => 'individuals',
                // 'description_ar' => 'xx',
                // 'description_en' => 'x',
                'monthly_price' => '300',
                'annual_price' => '600',
                'monthly_price_after_discount' => '250',
                'annual_price_after_discount' => '550',
                'discount_from_date' => '2023-12-6',
                'discount_to_date' => '2023-12-6',
            ],
            [
                'id' => 2,
                'name_ar' => 'وكالة',
                'name_en' => 'exhibition',
                // 'description_ar' => '',
                // 'description_en' => '',
                'monthly_price' => '2500',
                'annual_price' => '5000',
                'monthly_price_after_discount' => '2000',
                'annual_price_after_discount' => '4000',
                'discount_from_date' => '2023-12-6',
                'discount_to_date' => '2024-12-6',
            ],
            [
                'id' => 3,
                'name_ar' => 'معرض',
                'name_en' => 'agency',
                // 'description_ar' => '',
                // 'description_en' => '',
                'monthly_price' => '2500',
                'annual_price' => '5000',
                'monthly_price_after_discount' => '2000',
                'annual_price_after_discount' => '4000',
                'discount_from_date' => '2023-12-6',
                'discount_to_date' => '2024-12-6',
            ]
        ];
        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
