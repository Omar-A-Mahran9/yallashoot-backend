<?php

namespace App\Http\Controllers\Api;

use App\Models\Faq;
use App\Models\News;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use Artisan;

class SettingController extends Controller
{
    public function footer()
    {
        try
        {
            $data = [
                'logo' => getImagePathFromDirectory(settings()->getSettings('logo'), 'Settings'),
                'description' => settings()->getSettings('footer_text_' . getLocale()),
                'whatsapp_phone' => settings()->getSettings('whatsapp'),
                'facebook' => settings()->getSettings('facebook_url'),
                'twitter' => settings()->getSettings('twitter_url'),
                'instagram' => settings()->getSettings('instagram_url'),
                'youtube' => settings()->getSettings('youtube_url'),
                'snapchat' => settings()->getSettings('snapchat_url'),
                'tiktok' => settings()->getSettings('tiktok'),
                'whatsapp' => settings()->getSettings('whatsapp_url'),
                'working_time' => settings()->getSettings('working_time'),

            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function finance()
    {
        try
        {
            return $this->success(data: settings()->getSettings('finance_text_in_home_page_' . getLocale()));
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function cach(){
        Artisan::call('cache:clear');

        echo "Cache cleared successfully.";
    }
    public function cars_news()
    {
        try
        {
            $newses = News::take(6)->get();
            $newses->map(function ($news) {
                $news['highlighted_image'] = getImagePathFromDirectory($news['highlighted_image'], 'News');
                $news['main_image']        = getImagePathFromDirectory($news['main_image'], 'News');
            });
            $data = [
                'description' => settings()->getSettings('cars_news_text_in_cars_news_page_' . getLocale()),
                'news' => $newses
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function track_order()
    {
        try
        {
            return $this->success(data: settings()->getSettings('track_order_text_in_track_order_page_' . getLocale()));
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function contact_us()
    {
        try
        {
            
            $data = [
                'description' => settings()->getSettings('contact_us_text_in_contact_us_page_' . getLocale()),
                'email' => settings()->getSettings('email'),
                'phone' => settings()->getSettings('phone'),
                'address' => settings()->getSettings('address'),
                'tiktok' => settings()->getSettings('tiktok'),
                'facebook' => settings()->getSettings('facebook_url'),
                'whatsapp' => settings()->getSettings('whatsapp_url'),
                'twitter' => settings()->getSettings('twitter_url'),
                'instagram' => settings()->getSettings('instagram_url'),
                'youtube' => settings()->getSettings('youtube_url'),
                'snapchat' => settings()->getSettings('snapchat_url'),
                'address_iframe' => settings()->getSettings('address_iframe'),
            ];

            $iframeTag = settings()->getSettings('address_iframe');

            // Use preg_match to extract src attribute value
            if (preg_match('/<iframe[^>]+src="?\'?([^"\'>]+)"?\'?[^>]*>/i', $iframeTag, $matches)) {
                // Check if the match was successful
                if (isset($matches[1])) {
                    // Assign the src attribute value to $data['src']
                    $data['src'] = $matches[1];
                } else {
                    // Handle the case where the src attribute is not found
                    $data['src'] = null; // or any default value you prefer
                }
            } else {
                // Handle the case where the regex match is not successful
                $data['src'] = null; // or any default value you prefer
            }
             return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function social()
    {
        try
        {
            $data = [
                'tiktok' => settings()->getSettings('tiktok'),
                'facebook' => settings()->getSettings('facebook_url'),
                'twitter' => settings()->getSettings('twitter_url'),
                'whatsapp' => settings()->getSettings('whatsapp_url'),
                'instagram' => settings()->getSettings('instagram_url'),
                'youtube' => settings()->getSettings('youtube_url'),
                'snapchat' => settings()->getSettings('snapchat_url'),
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function about()
    {
        try
        {
            $data = [
                'description' => settings()->getSettings('about_us_' . getLocale()),
                'description_card' => settings()->getSettings('about_us_description_' . getLocale()),
                'card_left' => settings()->getSettings('about_us_card_left_' . getLocale()),
                'card_right' => settings()->getSettings('about_us_card_right_' . getLocale()),
                'text_card_left' => settings()->getSettings('about_us_section_card_left_' . getLocale()),
                'text_card_right' => settings()->getSettings('about_us_section_card_right_' . getLocale()),
                'image' => getImagePathFromDirectory(settings()->getSettings('who_code_car_photo'), 'Settings'),
                'icon_card_left' => getImagePathFromDirectory(settings()->getSettings('about_us_card_left_icon'), 'Settings'),
                'icon_card_right' => getImagePathFromDirectory(settings()->getSettings('about_us_card_right_icon'), 'Settings'),
                'faq' => Faq::get(),
            ];
 
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }
    public function filter_count(){
        $car=Car::get();
 
        // Assuming 'status' is the attribute that indicates whether a car is new or used
        $usedCount = $car->where('is_new', '0')->count();
        $newCount = $car->where('is_new', '1')->count();
        $automatic_gear = $car->where('gear_shifter', 'automatic')->count();
        $manual_gear = $car->where('gear_shifter', 'manual')->count();

        
        $data = [
            'used' => $usedCount,
            'new' => $newCount,
            'automatic'=>$automatic_gear,
            'automatic'=>$manual_gear,

            
        ];
        return $this->success(data: $data);

     

    }

    public function offer()
    {
        try
        {
            $offers = Offer::where('status', 1)->get();
            $offers->map(function ($offer) {
                $offer['image'] = getImagePathFromDirectory($offer['image'], 'Offers');
            });
            $data = [
                'description' => settings()->getSettings('offer_text_in_offer_page_' . getLocale()),
                'offers' => $offers
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function termsCondition()
    {
        try
        {
            $data = [
                'privacy' => settings()->getSettings('privacy_policy_' . getLocale()),
                'terms_and_conditions'=>settings()->getSettings('terms_and_conditions_' . getLocale()),
             ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function setting(){
        return $this->success(data:settings()->getSettings('setting_' . getLocale()));

    }
    public function AllDescription(){
        
        $data = [
            'financeDescription' => settings()->getSettings('finance_text_in_home_page_' . getLocale()),
            'followyourOrder' => settings()->getSettings('track_order_text_in_track_order_page_' . getLocale()),
            'ProfileDescription' => settings()->getSettings('setting_profile_ar' . getLocale()),
            'addYourads' => settings()->getSettings('add_ads_' . getLocale()),
            'exhibitionDescription' => settings()->getSettings('exhibition_text_in_exhibition_page_' . getLocale()),
            'settingprofile'=>settings()->getSettings('setting_profile_' . getLocale()),
            'Min_year_of_ads'=>settings()->getSettings('Last_year_of_ads'),
            'Min_year_of_finance'=>settings()->getSettings('Last_year_of_finance'),
            'video_url'=>settings()->getSettings('about_us_video'),
            'main_url' => url('/')."/api"


        ];
        return $this->success(data:$data);

    }
}
