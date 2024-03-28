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
            'name' => 'yallashoot',
            'email' => 'yallashoot@gmail.com',
            'password' => 'yallashoot1122334455',
            'phone' => '966511223344',
        ]);

        Employee::create([
            'name' => 'OmarSupport',
            'email' => 'support@gmial.com',
            'password' => 'OmarSupport1122334455',
            'phone' => '966522334455',
        ]);
    }
}
