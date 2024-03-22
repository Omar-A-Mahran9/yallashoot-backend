<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->delete();
        $data = [
            [
                'id'=>1,
                'name_ar' =>'فرد',
                'name_en' =>'Individual'
            ],
            [
                'id'=>2,
                'name_ar' =>'معرض',
                'name_en' =>'Exhibition'
            ],
            [
                'id'=>3,
                'name_ar' =>'وكالة',
                'name_en' =>'Agency'
            ]
        ];

        foreach ($data as $item){
            UserType::create($item);
        }

    }
}
