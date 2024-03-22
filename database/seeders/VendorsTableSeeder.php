<?php

namespace Database\Seeders;

use App\Enums\VendorStatus;
use DB;
use Hash;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $numberOfVendors = 10;

        
            DB::table('vendors')->insert([
                'image' => 'webstdy_1708911503logo-1-dark.svg',
                'name' => 'Code Car',
                'phone' => '0503245843',
                'another_phone' => '0503245843',
                // 'address' => 'Vendor Address ' . $i,
                'status' => VendorStatus::approved->value,
                'type' => 'agency',
                'city_id' => 1, // Assuming city_id corresponds to an existing city
                'identity_no' => '1122334566',
                'commercial_registration_no' => 'CRN',
                'google_maps_url' => 'https://maps.google.com/?q=',
                'password' => Hash::make('codecar1122334455'), // You may want to use a better method to hash passwords
                'created_by' => 1, // Assuming created_by corresponds to an existing employee ID
                'verification_code' => null,
                'verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
 
    }
}
