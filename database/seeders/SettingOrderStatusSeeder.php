<?php

namespace Database\Seeders;

use App\Models\SettingOrderStatus;
use Illuminate\Database\Seeder;

class SettingOrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_ar' => 'جديد',
                'name_en' => 'new',
                'color' => '#C3E2C2',
            ],
 
            [
                'name_ar' => 'تحت الدراسة',
                'name_en' => 'processing',
                'color' => '#607274',
            ],
            [
                'name_ar' => 'موافقة',
                'name_en' => 'accepted',
                'color' => '#C6E2C2',
            ],
            [
                'name_ar' => 'مرفوضة',
                'name_en' => 'rejected',
                'color' => '#c30000',
            ],
            [
                'name_ar' => 'بانتظار ارسال المستندات',
                'name_en' => 'please send your paper',
                'color' => '#5F8670',
            ],
            [
                'name_ar' => 'تم الإستلام',
                'name_en' => 'delivered',
                'color' => '#00348a',
            ],
            [
                'name_ar' => 'التعميد',
                'name_en' => 'Finance approvals',
                'color' => '#003489',
            ],
        ];
        foreach ($data as $record) {
            SettingOrderStatus::create($record);
        }
    }
}
