<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'codecar',
            'email' => 'codecar@gmail.com',
            'password' => 'codecar1122334455',
            'phone' => '966511223344',
        ]);

        Employee::create([
            'name' => 'webstdy',
            'email' => 'support@webstdy.com',
            'password' => 'webstdy987321',
            'phone' => '966522334455',
        ]);
    }
}
