<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            NationalitySeeder::class,
            SectorSeeder::class,
            BankSeeder::class,
            ColorSeeder::class,
            TagSeeder::class,
            BrandSeeder::class,
            ModelSeeder::class,
            CitySeeder::class,
            OffersSeeder::class,
            FeatureSeeder::class,
            PackageSeeder::class,
            FeaturePackageSeeder::class,
            SettingSeeder::class,
            SettingOrderStatusSeeder::class,
            CategoriesTableSeeder::class,
            VendorsTableSeeder::class,
            CarsTableSeeder::class,
            UserTypeSeeder::class,
            OrganizationTypesTableSeeder::class,
            FavoriteSeeder::class,
            FaqSeeder::class,
            CareerSeeder::class,
        ]);
    }
}
