<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
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
                'option_name' => 'website_name_ar',
                'option_value' => 'كود كار'
            ],
            [
                'option_name' => 'website_name_en',
                'option_value' => 'CodeCar'
            ],
            [
                'option_name' => 'about_us_video',
                'option_value' => 'https://youtu.be/jqk9nZBDb8Y'
            ],
            [
                'option_name' => 'working_time',
                'option_value' => 'https://www.facebook.com/'
            ],
            [
                'option_name' => 'working_time',
                'option_value' => 'من الأحد الى الخميس من الساعة ٨ صباحا حتى ١٠ مساءا'
            ],
            [
                'option_name' => 'whatsapp_url',
                'option_value' => 'https://www.facebook.com/'
            ],
            [
                'option_name' => 'twitter_url',
                'option_value' => 'https://www.facebook.com/'
            ],
            [
                'option_name' => 'instagram_url',
                'option_value' => 'https://www.facebook.com/'
            ],
            [
                'option_name' => 'youtube_url',
                'option_value' => 'https://www.facebook.com/'
            ],
            [
                'option_name' => 'snapchat_url',
                'option_value' => 'https://www.facebook.com/'
            ],
            [
                'option_name' => 'email',
                'option_value' => 'melshawardy@gmail.com'
            ],
            [
                'option_name' => 'phone',
                'option_value' => '0503245843'
            ],
            [
                'option_name' => 'tiktok',
                'option_value' => 'https://www.tiktok.com/'
            ],
            [
                'option_name' => 'tax',
                'option_value' => '12'
            ],
            [
                'option_name' => 'males_insurance',
                'option_value' => '3.75'
            ],
            [
                'option_name' => 'females_insurance',
                'option_value' => '6.75'
            ],
            [
                'option_name' => 'maintenance_mode',
                'option_value' => '0'
            ],
            [
                'option_name' => 'meta_tag_description_ar',
                'option_value' => 'asdasd'
            ],
            [
                'option_name' => 'meta_tag_description_en',
                'option_value' => 'asdasd'
            ],
            [
                'option_name' => 'meta_tag_keyword_ar',
                'option_value' => 'asdasd'
            ],
            [
                'option_name' => 'meta_tag_keyword_en',
                'option_value' => 'asdasd'
            ],
            [
                'option_name' => 'financing_body_text_in_home_page_ar',
                'option_value' => 'قسم ميزة التمويل في الصفحة الرئيسية بالعربية'
            ],
            [
                'option_name' => 'financing_body_text_in_home_page_en',
                'option_value' => 'قسم ميزة التمويل في الصفحة الرئيسية بالإنجليزية'
            ],
            [
                'option_name' => 'brand_text_in_home_page_ar',
                'option_value' => NULL
            ],
            [
                'option_name' => 'brand_text_in_home_page_en',
                'option_value' => NULL
            ],
            [
                'option_name' => 'privacy_policy_ar',
                'option_value' => '<p>sdf<\/p>'
            ],
            [
                'option_name' => 'privacy_policy_en',
                'option_value' => '<p>sdf<\/p>'
            ],
            [
                'option_name' => 'terms_and_conditions_en',
                'option_value' => '<p>sdf<\/p>'
            ],
            [
                'option_name' => 'terms_and_conditions_ar',
                'option_value' => '<p>sdf<\/p>'
            ],
            [
                'option_name' => 'slider_dashboard_username',
                'option_value' => NULL
            ],
            [
                'option_name' => 'slider_dashboard_password',
                'option_value' => NULL
            ],
            [
                'option_name' => 'about_us_ar',
                'option_value' => 'عن موقعك بالعربية'
            ],
            [
                'option_name' => 'about_us_en',
                'option_value' => 'عن موقعك بالانجليزية'
            ],
            [
                'option_name' => 'financing_advantage_photo',
                'option_value' => NULL
            ],
            [
                'option_name' => 'why_code_car_cars_ar',
                'option_value' => 'لماذا كود كار بالعربية'
            ],
            [
                'option_name' => 'why_code_car_cars_en',
                'option_value' => 'dfs'
            ],
            [
                'option_name' => 'why_code_car_cars_card_1_ar',
                'option_value' => 'كارت 1 لماذا كود كار بالعربية'
            ],
            [
                'option_name' => 'why_code_car_cars_card_1_en',
                'option_value' => 'ddd'
            ],
            [
                'option_name' => 'why_code_car_cars_card_2_ar',
                'option_value' => 'كارت 2 لماذا كود كار بالعربية'
            ],
            [
                'option_name' => 'why_code_car_cars_card_2_en',
                'option_value' => 'fgd'
            ],
            [
                'option_name' => 'why_code_car_cars_card_3_ar',
                'option_value' => 'كارت 3 لماذا كود كار بالعربية'
            ],
            [
                'option_name' => 'why_code_car_cars_card_3_en',
                'option_value' => 'كارت 3 لماذا كود كار بالانجليزية'
            ],
            [
                'option_name' => 'footer_text_ar',
                'option_value' => 'نص التذييلة بالعربية'
            ],
            [
                'option_name' => 'footer_text_en',
                'option_value' => 'نص التذييلة بالانجليزية'
            ],
            [
                'option_name' => 'currency',
                'option_value' => 'SAR'
            ],
            [
                'option_name' => 'logo',
                'option_value' => NULL
            ],
            [
                'option_name' => 'favicon',
                'option_value' => NULL
            ],
            [
                'option_name' => 'financing_advantage_ar',
                'option_value' => 'قسم ميزة التمويل في الصفحة الرئيسية بالعربية'
            ],
            [
                'option_name' => 'financing_advantage_en',
                'option_value' => 'قسم ميزة التمويل في الصفحة الرئيسية بالإنجليزية'
            ],
            [
                'option_name' => 'who_code_car_photo',
                'option_value' => NULL
            ],
            [
                'option_name' => 'about_us_photo',
                'option_value' => NULL
            ],
            [
                'option_name' => 'finance_text_in_home_page_ar',
                'option_value' => 'نص قسم التمويل في صفحة التمويل بالعربية'
            ],
            [
                'option_name' => 'finance_text_in_home_page_en',
                'option_value' => 'نص قسم التمويل في صفحة التمويل بالإنجليزية'
            ],
            [
                'option_name' => 'offer_text_in_offer_page_ar',
                'option_value' => 'نص قسم العروض في صفحة العروض بالعربية'
            ],
            [
                'option_name' => 'offer_text_in_offer_page_en',
                'option_value' => 'نص قسم العروض في صفحة العروض بالإنجليزية'
            ],
            [
                'option_name' => 'exhibition_text_in_exhibition_page_ar',
                'option_value' => 'نص قسم المعرض في صفحة المعرض بالعربية'
            ],
            [
                'option_name' => 'exhibition_text_in_exhibition_page_en',
                'option_value' => 'نص قسم المعرض في صفحة المعرض بالإنجليزية'
            ],
             [
                'option_name' => 'setting_profile_ar',
                'option_value' => 'نص قسم المعرض في صفحة المعرض بالعربية'
            ],
            [
                'option_name' => 'setting_profile_en',
                'option_value' => 'نص قسم المعرض في صفحة المعرض بالإنجليزية'
            ],
            [
                'option_name' => 'Last_year_of_ads',
                'option_value' => 2024
            ],
            [
                'option_name' => 'Last_year_of_finance',
                'option_value' => 2024
            ],
            [
                'option_name' => 'cars_news_text_in_cars_news_page_ar',
                'option_value' => 'نص قسم اخبار السيارات في صفحة اخبار السيارات بالعربية'
            ],
            [
                'option_name' => 'cars_news_text_in_cars_news_page_en',
                'option_value' => 'نص قسم اخبار السيارات في صفحة اخبار السيارات بالإنجليزية'
            ],
            [
                'option_name' => 'track_order_text_in_track_order_page_ar',
                'option_value' => 'نص قسم تتبع طلبك في صفحة تتبع طلبك بالعربية'
            ],
            [
                'option_name' => 'track_order_text_in_track_order_page_en',
                'option_value' => 'نص قسم تتبع طلبك في صفحة تتبع طلبك بالإنجليزية'
            ],
            [
                'option_name' => 'contact_us_text_in_contact_us_page_ar',
                'option_value' => 'نص قسم اتصل بنا في صفحة اتصل بنا بالعربية'
            ],
            [
                'option_name' => 'contact_us_text_in_contact_us_page_en',
                'option_value' => 'نص قسم اتصل بنا في صفحة اتصل بنا بالإنجليزية'
            ],
            [
                'option_name' => 'about_us_description_ar',
                'option_value' => 'منصة موقع كود كار تختص في بيع وشراء وتمويل السيارات بطرق حديثة ومتطورة لتصل الى كل من يرغب أن يعلن او يبحث عن سيارة أحلامه نقداً او عن طريق التمويل التأجيري مع أفضل جهات التمويل بالمملكة العربية السعودية .
                نحن ثقتكم التي نفتخر بها و التميز الذي نضعه بين أيديكم لننال رضاكم ولنكون الطريق المتميز لأيصالكم لأهدافكم بالحصول على طلبك بكل سهولة وسرعة وبشكل مرضي ..'
            ],
            [
                'option_name' => 'about_us_description_en',
                'option_value' => 'The Code Car T website platform specializes in buying, purchasing and financing cars in modern and advanced ways, so that Onoki is sure to advertise the car of his dreams in cash or through leasing financing with the best financing agencies in the Kingdom of Saudi Arabia.
                We are your trust, which we are proud of, and the distinction that we enjoy in your hands to gain your satisfaction and to be the distinguished way to deliver your goals to your benefit with ease and satisfactory speed..'
            ],
            [
                'option_name' => 'about_us_card_left_ar',
                'option_value' => '<h6>ما يميزنا</h6>
                حلول تمويلية فريدة هي ما يميزنا، نقدم لك حلاً متخصصاً يلبي احتياجاتك في عالم السيارات.'
            ],
            [
                'option_name' => 'about_us_card_left_en',
                'option_value' => '<h6>ما يميزنا</h6>
                حلول تمويلية فريدة هي ما يميزنا، نقدم لك حلاً متخصصاً يلبي احتياجاتك في عالم السيارات.'
            ],
            [
                'option_name' => 'about_us_card_right_ar',
                'option_value' => '<h6>اهدافنا</h6>
                نسعي لتقديم خدمات فائقة المستوى وتجربة فريدة، لتحقيق تطلعات عشاق السيارات بكفاءة وراحة.'
            ],
            [
                'option_name' => 'about_us_card_right_en',
                'option_value' => '<h6>اهدافنا</h6>
                نسعي لتقديم خدمات فائقة المستوى وتجربة فريدة، لتحقيق تطلعات عشاق السيارات بكفاءة وراحة.'
            ],
            [
                'option_name' => 'address',
                'option_value' => '45 El-Batal Ahmed Abd El-Aziz, Al Huwaiteyah, Agouza, Giza Governorate 12655'
            ],
            [
                'option_name' => 'address_iframe',
                'option_value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.377599546711!2d31.202060976201665!3d30.05470911808314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584177183e24c1%3A0x89be8a01ae6e26bd!2zV2ViU1REWSAtINmI2YrYqCDYs9iq2K_Zig!5e0!3m2!1sen!2seg!4v1704114810770!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ],
            [
                'option_name' => 'financing_advantage_card_1_ar',
                'option_value' => 'كارت 1 ميزة التمويل في الصفحة الرئيسية بالعربية'
            ],
            [
                'option_name' => 'financing_advantage_card_1_en',
                'option_value' => 'كارت 1 ميزة التمويل في الصفحة الرئيسية بالإنجليزية'
            ],
            [
                'option_name' => 'financing_advantage_card_2_ar',
                'option_value' => 'كارت 2 ميزة التمويل في الصفحة الرئيسية بالعربية'
            ],
            [
                'option_name' => 'financing_advantage_card_2_en',
                'option_value' => 'كارت 2 ميزة التمويل في الصفحة الرئيسية بالإنجليزية'
            ],
            [
                'option_name' => 'financing_advantage_card_1_icon',
                'option_value' => NULL
            ],
            [
                'option_name' => 'financing_advantage_card_2_icon',
                'option_value' => NULL
            ],
            [
                'option_name' => 'financing_advantage_text_card_1_ar',
                'option_value' => 'نص كارت 1 ميزة التمويل في الصفحة الرئيسية بالعربية'
            ],
            [
                'option_name' => 'financing_advantage_text_card_1_en',
                'option_value' => 'نص كارت 1 ميزة التمويل في الصفحة الرئيسية بالإنجليزية'
            ],
            [
                'option_name' => 'financing_advantage_text_card_2_ar',
                'option_value' => 'نص كارت 2 ميزة التمويل في الصفحة الرئيسية بالعربية'
            ],
            [
                'option_name' => 'financing_advantage_text_card_2_en',
                'option_value' => 'نص كارت 2 ميزة التمويل في الصفحة الرئيسية بالإنجليزية'
            ],
            [
                'option_name' => 'why_code_car_section_card_1_ar',
                'option_value' => 'نص كارت 1 لماذا كود كار بالعربية'
            ],
            [
                'option_name' => 'why_code_car_section_card_1_en',
                'option_value' => 'eee'
            ],
            [
                'option_name' => 'why_code_car_section_card_2_ar',
                'option_value' => 'نص كارت 2 لماذا كود كار بالعربية'
            ],
            [
                'option_name' => 'why_code_car_section_card_2_en',
                'option_value' => 'dddd'
            ],
            [
                'option_name' => 'why_code_car_section_card_3_ar',
                'option_value' => 'نص كارت 3 لماذا كود كار بالإنجليزية'
            ],
            [
                'option_name' => 'why_code_car_section_card_3_en',
                'option_value' => 'نص كارت 3 لماذا كود كار بالعربية'
            ],
            [
                'option_name' => 'add_ads_ar',
                'option_value' => NULL
            ],
            [
                'option_name' => 'add_ads_en',
                'option_value' => NULL
            ],
            [
                'option_name' => 'why_code_car_icon_card_1',
                'option_value' => NULL
            ],
            [
                'option_name' => 'why_code_car_icon_card_2',
                'option_value' => NULL
            ],
            [
                'option_name' => 'why_code_car_icon_card_3',
                'option_value' => NULL
            ],
            [
                'option_name' => 'about_us_card_left_icon',
                'option_value' => NULL
            ],
            [
                'option_name' => 'about_us_card_right_icon',
                'option_value' => NULL
            ],
            [
                'option_name' => 'setting_ar',
                'option_value' => NULL
            ],
            [
                'option_name' => 'setting_en',
                'option_value' => NULL
            ],
            [
                'option_name' => 'about_us_section_card_left_ar',
                'option_value' => 'ghghghghg',
            ],
            [
                'option_name' => 'about_us_section_card_left_en',
                'option_value' => 'ghghghghg',
            ],
            [
                'option_name' => 'about_us_section_card_right_ar',
                'option_value' => 'ghghghghg',
            ],
            [
                'option_name' => 'about_us_section_card_right_en',
                'option_value' => 'ghghghghg',
            ],
        ];
        foreach ($data as $item)
        {
            Setting::create($item);
        }
    }
}
