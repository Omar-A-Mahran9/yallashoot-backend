<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'id' => 1,
                'question' => 'هل يمكنني بيع سياراتي',
                'answer' => 'نعم',
            ],
            [
                'id' => 2,
                'question' => 'هل يمكنني بيع سياراتي',
                'answer' => 'نعم',
            ]
        ];

        foreach ($faqs as $faq)
        {
            Faq::create($faq);
        }
    }
}
