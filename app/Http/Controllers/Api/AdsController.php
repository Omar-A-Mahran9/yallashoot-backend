<?php

namespace App\Http\Controllers\Api;

use App\Enums\CarStatus;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\OrderNotification;
use App\Rules\NotNumbersOnly;
use Auth;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    private function uploadCarImages( $images )
    {
        $imagesNames = [];

        foreach ( $images as $index => $image )
        {
            $imagesNames[$index] = uploadImage( $image , "Cars");
        }

        return $imagesNames;
    }
    private function setCarName(&$data)
    {
        $brand    = Brand::find( $data['brand_id'] , ['id','name_ar','name_en']);
        $model    = CarModel::find( $data['model_id'] , ['id','name_ar','name_en']);
        $data['name_ar'] = $brand->name_ar . ' ' . $model->name_ar. ' ' . $data['year'];
        $data['name_en'] = $brand->name_en . ' ' . $model->name_en. ' ' .  $data['year'];
    }
    public function storeBrandCarsTypeCount($carType, $brandId)
    {
            $brand = Brand::find($brandId);

            if($brand->car_available_types != 'both')
            {
                 if($carType == 1)
                {
                    if($brand->car_available_types != 'used' )
                        $brand->update(['car_available_types' => 'new']);
                    else $brand->update(['car_available_types' => 'both']);
                }
                else
                {
                    if($brand->car_available_types != 'new')
                        $brand->update(['car_available_types' => 'used']);
                    else $brand->update(['car_available_types' => 'both']);
                }
            }

    }
    public function store(Request $request ){
  
                // Check if 'step' is present in the request
                if ($request->has('step')) {
                    $step = $request->step;

                    // Return a response for invalid steps
                    if (!in_array($step, [0, 1])) {
                        return response()->json(['error' => 'Invalid or missing step parameter'], 400);
                    }

                    // Perform validation based on the step
                    if ($step == 0) {
                        $request->validate([
                            // 'Car_Name' => ['required' , 'string','max:255'],
                            'Car_Description' => ['required' , 'string',new NotNumbersOnly],
                            // 'Car_Description_en' => ['required' , 'string',new NotNumbersOnly],
                            'Car_Brand' => ['required'],
                            'Car_Model' => ['required'],
                            'Car_Year' => ['required'],
                            'Car_Statue' => ['required'],
                            'Gear_shifter' => ['required'],
                            'Killometer' => ['required_if:is_new,0', 'numeric', 'nullable', 'min:0'],
                            'Fuel_Type' => 'required|in:gasoline,diesel,electric,hybrid',
                            'Supplier' => 'required',
                            'Car_Color'=>['required'],
                            'Car_style' => ['required'],
                            'fuel_tank_capacity' => ['required', 'numeric','min:800'],
                            'City' => ['required'],
                            'Category' => ['nullable'],
                            'Car_Price' => 'required|numeric|not_in:0',
                            'Car_Price_after_Discount' => 'nullable|numeric|lt:Car_Price',
                        ]);
                        return response()->json(['massage' => 'validation step 1 is successfully'], 200);

                    } elseif ($step == 1) {
                        $request->validate([
                            // 'Main_Image' => 'required|mimes:jpeg,png,jpg,svg,webp',
                            'Images'    => ['required','array','min:2','max:15'],
                            'Images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', 
                        ]);
                       
                        $data=[
                            'vendor_id'=>Auth::user()->id,
                            'ad_name' => null,
                            'description_ar'=> $request['Car_Description'],
                            'description_en'=> $request['Car_Description'],
                            'brand_id' => $request['Car_Brand'],
                            'model_id' => $request['Car_Model'],
                            'city_id'=>$request['City'],
                            'fuel_tank_capacity'=>$request['fuel_tank_capacity'],
                            'category_id'=>$request['Category'],
                            'year' =>$request['Car_Year'],
                            'is_new' => $request['Car_Statue'],
                            'status'=>CarStatus::pending->value,
                            'gear_shifter' => $request['Gear_shifter'],
                            'kilometers' =>  $request['Killometer'],
                            'fuel_type' => $request['Fuel_Type'],
                            'supplier' =>$request['Supplier'],
                            'color_id'=>$request['Car_Color'],
                            'price' =>$request['Car_Price'],
                            'car_body' =>$request['Car_style'],
                            'discount_price' => $request['Car_Price_after_Discount'],
                            'main_image' => uploadImage( $request['Main_Image'], "Cars"),
                        ];
 
                        $this->setCarName($data);
                        $car = Car::create($data);
                        $this->storeBrandCarsTypeCount($data['is_new'], $data['brand_id']);
    
                        if ($request->file('Images')){
                            $images=$this->uploadCarImages($request->file('Images'));
                            foreach( $images as $image){
                                $imageData=[
                                    'car_id'=>$car->id,
                                    'image'=>$image,
                                ];
                                CarImage::create($imageData);
                            }
                         }
                         $notify=[
                            'vendor_id'=>Auth::id()??null,
                            'ad_id'=>$car->id,
                            'is_read'=>false,
                            'phone'=>auth()->user()->phone??null,
                            'type'=>'ads',
                           ];
                          OrderNotification::create($notify);
                        return response()->json(['error' => 'Your ad Added Successfully'], 200);

                    }
                    }

 
 

}
}