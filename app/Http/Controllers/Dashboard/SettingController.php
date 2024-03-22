<?php

namespace App\Http\Controllers\Dashboard;

use App\Rules\NotUrl;
use App\Models\Setting;
use App\Models\RevSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSettingRequest;
use App\Models\SettingOrderStatus;

class SettingController extends Controller
{
    public function index()
    {
        // $sliders = RevSlider::get();
        $aboutUsVideoId = settings()->getSettings('about_us_video');
        $this->getYoutubeVideoUrl($aboutUsVideoId);
        $fullYoutubeUrl = ($aboutUsVideoId) ? $this->getYoutubeVideoUrl($aboutUsVideoId) : null;
        $this->authorize('view_settings');
        $settings      = Setting::get();
        $orderStatuses = SettingOrderStatus::get();
        // return view('dashboard.settings', compact('sliders'));
        return view('dashboard.settings', compact('settings', 'orderStatuses','fullYoutubeUrl'));
    }

    protected function getYoutubeVideoUrl($videoId)
            {
            // Use a regular expression to extract the video ID from the YouTube URL
            $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
             // Check if the URL matches the pattern
           
                // Return the full YouTube URL
                return 'https://www.youtube.com/watch?v=' .$videoId;
            

            // Return null if no match is found
       
            }

    public function store(StoreSettingRequest $request)
    {
           $this->authorize('create_settings');
        $data = $request->validated();
        $data['phone']    = convertArabicNumbers($request['phone']);
        $data['whatsapp'] = convertArabicNumbers($request['whatsapp']);
        $data['about_us_video']=$this->getYoutubeVideoId($request['about_us_video']);

        $this->validateFiles('who_code_car_photo', 'about-website', $request, $data);
        $this->validateFiles('purchase_section_photo', 'about-website', $request, $data);
        $this->validateFiles('contact_us_section_photo', 'about-website', $request, $data);
        $this->validateFiles('about_us_photo', 'about-website', $request, $data);
        $this->validateFiles('financing_advantage_photo', 'about-website', $request, $data);
        $this->validateFiles('why_code_car_icon_card_1', 'about-website', $request, $data);
        $this->validateFiles('why_code_car_icon_card_2', 'about-website', $request, $data);
        $this->validateFiles('why_code_car_icon_card_3', 'about-website', $request, $data);
        $this->validateFiles('about_us_card_left_icon', 'about-website', $request, $data);
        $this->validateFiles('about_us_card_right_icon', 'about-website', $request, $data);
        $this->validateFiles('financing_advantage_card_1_icon', 'about-website', $request, $data);
        $this->validateFiles('financing_advantage_card_2_icon', 'about-website', $request, $data);
        $this->validateFiles('logo', 'general', $request, $data);
        $this->validateFiles('favicon', 'general', $request, $data);
        $this->validateFiles('purchase_section_photo', 'general', $request, $data);
        $deletestatues=$request->deletedstatus[0];
        $deletedIdsArray = explode(',', $deletestatues);
        $deletedIdsArray = array_map('intval', $deletedIdsArray);
        if($deletestatues){
            foreach ($deletedIdsArray as $id) {
                $statue=SettingOrderStatus::findOrFail($id);
                $statue->delete();
             }
        }
          foreach ($data['orders_statuses'] as $order)
        {
            
         $orderitem=SettingOrderStatus::find($order['id']);
         if($orderitem){
             $orderitem->update($order);
         }
         else{
            SettingOrderStatus::create($order);
         }
        }
        foreach ($data as $key => $value)
        {
          Setting::where('option_name', $key)->update(['option_value' => $value]);
        }
    }
    function getYoutubeVideoId($url)
    {
        // Use a regular expression to extract the video ID from the YouTube URL
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        
        // Check if the URL matches the pattern
        if (preg_match($pattern, $url, $matches)) {
            // Return the extracted video ID
            return $matches[1];
        }
    
        // Return null if no match is found
        return null;
    }
    private function validateFiles($keyName, $sectionName, Request $request, &$data)
    {
        if ($request->hasFile($keyName))
        {
            $request->validate([
                $keyName => ['bail', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:2048']
            ]);
            deleteImage(settings()->getSettings($keyName),'Settings');
            $data[$keyName] = uploadImage($request->file($keyName), "Settings");
        }
    }

    public function changeThemeMode(Request $request)
    {
        session()->put('theme_mode', $request->mode);
        return redirect()->back();
    }

    public function changeLanguage(Request $request)
    {
        session()->put('locale', $request->lang);
        return redirect()->back();
    }
}
