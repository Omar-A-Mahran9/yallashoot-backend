<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Bank::create([
        //     'name_ar' => 'مصر',
        //     'name_en' => 'Masr',
        //     'image' => 'webstdy_1648022291bmw_car_internal_images_3b.jpg',
        // ]);

        // Bank::create([
        //     'name_ar' => 'قطر',
        //     'name_en' => 'QNB',
        //     'image' => 'webstdy_1648022291bmw_car_internal_images_4.jpg',
        // ]);

        /*
            Sectors ID's
            id 1 => خاص
            id 2 => حكومي مدني
            id 3 => حكومي عسكري
            id 4 => متقاعد
            id 5 => قبائل نازحة
        */

        // $banksData = [
        //     [
        //         'name_ar' =>  'الاهلى',
        //         'name_en' =>  'الاهلى',
        //         'image' => 'webstdy_1648022291bmw_car_internal_images_4.jpg',
        //         'sectors' => [
        //             [
        //                 'id' => '2',
        //                 'benefit' => '0',
        //                 'support' => '105',
        //                 'advance' => '10',
        //                 'installment' => '2',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '1',
        //                 'benefit' => '3',
        //                 'support' => '0',
        //                 'advance' => '5',
        //                 'installment' => '1',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '3',
        //                 'benefit' => '0',
        //                 'support' => '110',
        //                 'advance' => '15',
        //                 'installment' => '3',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '4',
        //                 'benefit' => '0',
        //                 'support' => '110',
        //                 'advance' => '15',
        //                 'installment' => '3',
        //                 'administrative_fees' => rand(1,5)
        //             ],
 
        //         ]
        //     ],
        //     [
        //         'name_ar' =>  'التجارى وفا',
        //         'name_en' =>  'التجارى وفا',
        //         'image' => 'webstdy_1648022291bmw_car_internal_images_4.jpg',
        //         'sectors' => [
        //             [
        //                 'id' => '2',
        //                 'benefit' => '0',
        //                 'support' => '112',
        //                 'advance' => '25',
        //                 'installment' => '5',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '1',
        //                 'benefit' => '4',
        //                 'support' => '0',
        //                 'advance' => '20',
        //                 'installment' => '4',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '3',
        //                 'benefit' => '2',
        //                 'support' => '0',
        //                 'advance' => '30',
        //                 'installment' => '6',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '4',
        //                 'benefit' => '0',
        //                 'support' => '110',
        //                 'advance' => '15',
        //                 'installment' => '3',
        //                 'administrative_fees' => rand(1,5)
        //             ],
 
        //         ]
        //     ],
        //     [
        //         'name_ar' =>  'HSBC',
        //         'name_en' =>  'HSBC',
        //         'image' => 'webstdy_1648022291bmw_car_internal_images_4.jpg',
        //         'sectors' => [
        //             [
        //                 'id' => '2',
        //                 'benefit' => '0',
        //                 'support' => '105',
        //                 'advance' => '40',
        //                 'installment' => '8',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '1',
        //                 'benefit' => '5.50',
        //                 'support' => '0',
        //                 'advance' => '35',
        //                 'installment' => '7',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '3',
        //                 'benefit' => '1',
        //                 'support' => '0',
        //                 'advance' => '0',
        //                 'installment' => '9',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '4',
        //                 'benefit' => '0',
        //                 'support' => '110',
        //                 'advance' => '15',
        //                 'installment' => '3',
        //                 'administrative_fees' => rand(1,5)
        //             ],
               
        //         ]
        //     ],
        //     [
        //         'name_ar' =>  'QNB',
        //         'name_en' =>  'QNB',
        //         'image' => 'webstdy_1648022291bmw_car_internal_images_4.jpg',
        //         'sectors' => [
        //             [
        //                 'id' => '2',
        //                 'benefit' => '4',
        //                 'support' => '0',
        //                 'advance' => '0',
        //                 'installment' => '11',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '1',
        //                 'benefit' => '2',
        //                 'support' => '0',
        //                 'advance' => '0',
        //                 'installment' => '10',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '3',
        //                 'benefit' => '0',
        //                 'support' => '120',
        //                 'advance' => '0',
        //                 'installment' => '12',
        //                 'administrative_fees' => rand(1,5)
        //             ],
        //             [
        //                 'id' => '4',
        //                 'benefit' => '0',
        //                 'support' => '110',
        //                 'advance' => '15',
        //                 'installment' => '3',
        //                 'administrative_fees' => rand(1,5)
        //             ],
               
        //         ]
        //     ],

        // ];

        // foreach($banksData as $bankData){
        //     $bank  = Bank::create([
        //         'name_ar' => $bankData['name_ar'],
        //         'name_en' => $bankData['name_en'],
        //         'image' => $bankData['image'],
        //     ]);
        //     foreach($bankData['sectors'] as $sector){
        //         DB::table('bank_sector')->insert([
        //             'bank_id' =>  $bank->id,
        //             'sector_id' => $sector['id'],
        //             'benefit' => $sector['benefit'],
        //             'support' => $sector['support'],
        //             'advance' => $sector['advance'],
        //             'installment' => $sector['installment'],
        //             'administrative_fees' => $sector['administrative_fees']
        //         ]);
        //     }

        // }



    }
}
