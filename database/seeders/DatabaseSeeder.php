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
            CitySeeder::class,
            League_categorySeeder::class,

            SettingSeeder::class,
           
            UserTypeSeeder::class,
             FaqSeeder::class,
         ]);
    }
}
