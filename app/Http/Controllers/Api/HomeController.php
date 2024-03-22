<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use App\Models\Bank;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarResourse;
use App\Models\Car;
use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller
{
    public function brand()
    {
        try
        {
            $brands = Brand::withCount('countCars')->get();
 
            $brands->map(function ($brand) {
                $brand['image'] = getImagePathFromDirectory($brand['image'], 'Brands');
                $brand['cover'] = getImagePathFromDirectory($brand['cover'], 'Brands');
            });
            $data = [
                'description' => settings()->getSettings('brand_text_in_home_page_' . getLocale()),
                'brands' => $brands
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }

    }


    public function brands(){
        try
        {
            $brands = Brand::withCount('countCars')->with('models')->get();
             $brands->map(function ($brand) {
                $brand['image'] = getImagePathFromDirectory($brand['image'], 'Brands');
                $brand['cover'] = getImagePathFromDirectory($brand['cover'], 'Brands');
            });
            $data = [
                'description' => settings()->getSettings('brand_text_in_home_page_' . getLocale()),
                'brands' => $brands
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        } 
    }

    public function carsbrand($id){

        $cars=Car::where('brand_id',$id)->get();
        $data=CarResourse::collection( $cars );
        return $this->success(data: $data);


    }

    public function why_code_car()
    {
        try
        {
            $data = [
                'description' => settings()->getSettings('why_code_car_cars_' . getLocale()),
                'icon_card_1' => getImagePathFromDirectory(settings()->getSettings('why_code_car_icon_card_1'), 'Settings'),
                'icon_card_2' => getImagePathFromDirectory(settings()->getSettings('why_code_car_icon_card_2'), 'Settings'),
                'icon_card_3' => getImagePathFromDirectory(settings()->getSettings('why_code_car_icon_card_3'), 'Settings'),
                'why_code_car_label_card_1' => settings()->getSettings('why_code_car_section_card_1_' . getLocale()),
                'why_code_car_label_card_2' => settings()->getSettings('why_code_car_section_card_2_' . getLocale()),
                'why_code_car_label_card_3' => settings()->getSettings('why_code_car_section_card_3_' . getLocale()),
                'why_code_car_cars_card_1' => settings()->getSettings('why_code_car_cars_card_1_' . getLocale()),
                'why_code_car_cars_card_2' => settings()->getSettings('why_code_car_cars_card_2_' . getLocale()),
                'why_code_car_cars_card_3' => settings()->getSettings('why_code_car_cars_card_3_' . getLocale()),
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

    public function financing_advantage()
    {
        try
        {
            $data = [
                'description' => settings()->getSettings('financing_advantage_' . getLocale()),
                'image' => getImagePathFromDirectory(settings()->getSettings('financing_advantage_photo'), 'Settings'),
                'icon_card_1' => getImagePathFromDirectory(settings()->getSettings('financing_advantage_card_1_icon'), 'Settings'),
                'icon_card_2' => getImagePathFromDirectory(settings()->getSettings('financing_advantage_card_2_icon'), 'Settings'),
                'financing_advantage_label_card_1' => settings()->getSettings('financing_advantage_text_card_1_' . getLocale()),
                'financing_advantage_label_card_2' => settings()->getSettings('financing_advantage_text_card_2_' . getLocale()),
                'financing_advantage_card_1' => settings()->getSettings('financing_advantage_card_1_' . getLocale()),
                'financing_advantage_card_2' => settings()->getSettings('financing_advantage_card_2_' . getLocale()),
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }
    public function act_mod(){
        dd('omaa');
        }  
 
 
    public function financing_bodies()
    {
        try
        {
            $banks = Bank::get();
            $banks->map(function ($bank) {
                $bank['image'] = getImagePathFromDirectory($bank['image'], 'Banks');
            });
            $data = [
                'description' => settings()->getSettings('financing_body_text_in_home_page_' . getLocale()),
                'banks' => $banks
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }


}
