<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotUrl;
use App\Rules\youtubevalidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_settings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'website_name_ar' => ['required_if:setting_type,general', 'nullable', 'string', 'max:255'],
            'website_name_en' => ['required_if:setting_type,general', 'nullable', 'string', 'max:255'],
            // 'logo'                                             => ['required_if:setting_type,general', 'nullable', 'mimes:webp', 'max:2048'],
            // 'favicon'                                          => ['required_if:setting_type,general', 'nullable', 'mimes:webp', 'max:2048'],
            'facebook_url' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255'],
            'whatsapp_url' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255'],
            'about_us_video' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255',new youtubevalidation(),],
            'working_time' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255'],

            'twitter_url' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255'],
            'instagram_url' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255'],
            'youtube_url' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255'],
            'snapchat_url' => ['required_if:setting_type,general', 'url', 'nullable', 'string', 'max:255'],
            'email' => ['required_if:setting_type,general', 'nullable', 'string', 'max:255'],
            'phone' => ['required_if:setting_type,general', 'nullable', 'string', 'max:255'],
            'tiktok' => ['required_if:setting_type,general', 'nullable', 'string', 'max:255'],
            'address' => ['required_if:setting_type,general', 'nullable', 'string', 'max:255'],
            'address_iframe' => ['required_if:setting_type,general', 'nullable', 'string'],
            'tax' => ['required_if:setting_type,general', 'numeric', 'between:0,100'],
            'Last_year_of_ads' => ['required_if:setting_type,general', 'digits:4','integer', 'lte:' . date('Y')],
            'Last_year_of_finance' => ['required_if:setting_type,general', 'digits:4', 'lte:' . date('Y'),],
            'males_insurance' => ['required_if:setting_type,general', 'numeric', 'between:0,100'],
            'females_insurance' => ['required_if:setting_type,general', 'numeric', 'between:0,100'],
            'maintenance_mode' => ['required_if:setting_type,general', 'nullable', 'string', 'max:255'],
            'orders_statuses' => ['required_if:setting_type,general', 'array'],
            'orders_statuses.*.name_ar' => ['required_if:setting_type,general'],
            'orders_statuses.*.name_en' => ['required_if:setting_type,general'],
            'orders_statuses.*.color' => ['required_if:setting_type,general'],
            'meta_tag_description_ar' => ['required_if:setting_type,seo', 'nullable', 'string', 'max:255'],
            'meta_tag_description_en' => ['required_if:setting_type,seo', 'nullable', 'string', 'max:255'],
            'meta_tag_keyword_ar' => ['required_if:setting_type,seo', 'nullable', 'string', 'max:255'],
            'meta_tag_keyword_en' => ['required_if:setting_type,seo', 'nullable', 'string', 'max:255'],
            'brand_text_in_home_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'brand_text_in_home_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'financing_body_text_in_home_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'financing_body_text_in_home_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'finance_text_in_home_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'finance_text_in_home_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'exhibition_text_in_exhibition_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'exhibition_text_in_exhibition_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'setting_profile_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'setting_profile_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'cars_news_text_in_cars_news_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'cars_news_text_in_cars_news_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'offer_text_in_offer_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'offer_text_in_offer_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'track_order_text_in_track_order_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'track_order_text_in_track_order_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'contact_us_text_in_contact_us_page_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'contact_us_text_in_contact_us_page_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'privacy_policy_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'privacy_policy_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'terms_and_conditions_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'terms_and_conditions_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'slider_dashboard_username' => ['required_if:setting_type,website', 'nullable', 'string'],
            'slider_dashboard_password' => ['required_if:setting_type,website', 'nullable', 'string'],
            //    'slider_ar'                                        => [ 'required_if:setting_type,website' ,'exists:revslider_sliders,alias'  ],
            //    'slider_en'                                        => [ 'required_if:setting_type,website' ,'exists:revslider_sliders,alias'  ],
            // 'financing_advantage_photo'                        => ['required_if:setting_type,about-website', 'nullable','mimes:webp', 'max:2048'],
            'add_ads_ar' => ['required_if:setting_type,website', 'nullable', 'string'],
            'add_ads_en' => ['required_if:setting_type,website', 'nullable', 'string'],
            'about_us_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_description_ar' => ['required', 'nullable', 'string'],
            'about_us_description_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_card_left_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_card_left_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_card_right_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_card_right_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_section_card_left_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_section_card_left_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_section_card_right_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'about_us_section_card_right_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_card_1_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_text_card_1_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_text_card_1_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_text_card_2_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_text_card_2_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_card_1_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_card_2_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'financing_advantage_card_2_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            // 'about_us_video_url'                               => ['required_if:setting_type,about-website', 'nullable', 'string', 'max:255', new NotUrl],
            'why_code_car_cars_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_cars_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            // 'why_code_car_section_card_1' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_section_card_1_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_section_card_1_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_section_card_2_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_section_card_2_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_section_card_3_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_section_card_3_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_cars_card_1_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_cars_card_1_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_cars_card_2_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_cars_card_2_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_cars_card_3_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'why_code_car_cars_card_3_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            // 'setting_ar' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            // 'setting_en' => ['required_if:setting_type,about-website', 'nullable', 'string'],
            'footer_text_ar' => ['required_if:setting_type,about-website', 'nullable', 'string', 'max:255'],
            'footer_text_en' => ['required_if:setting_type,about-website', 'nullable', 'string', 'max:255'],
        ];
    }
}
