<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Tag;
use App\Rules\NotNumbersOnly;
use App\Rules\ValidateMaxImages;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Storage;

use function App\Http\Controllers\store;
use function PHPUnit\Framework\isEmpty;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_cars');

        if ( $request->ajax() ) {

            $cars = getModelData( model: new Car() , relations: ['brand' => ['id' , 'name_' . getLocale() ] ] );

            return  response()->json($cars);
        }
        return view('dashboard.cars.index');
    }

    public function create()
    {
        $this->authorize('create_cars');
        // $models = CarModel::select('id','name_' . getLocale())->get();
        $brands = Brand::select('id','name_' . getLocale())->get();
        $cities = City::select('id','name_' . getLocale())->get();
        // $categories=Category::select('id','name_' . getLocale())->get();
        $colors = Color::select('id','image','name_' . getLocale(),'hex_code')->get();
        $tags   = Tag::select('id','name_' . getLocale() )->get();
        return view('dashboard.cars.create',compact('brands','colors','cities','tags'));
    }

    public function edit(Car $car)
    {
           
        $this->authorize('update_cars');

        $car->load('color');
        $models = CarModel::select('id','name_' . getLocale())->where('brand_id',$car->brand_id)->get();
        $brands = Brand::select('id','name_' . getLocale())->get();
        $cities = City::select('id','name_' . getLocale())->get();
        $categories=Category::select('id','name_' . getLocale())->where('car_model_id',$car->model_id)->get();
        $colors = Color::select('id','image','name_' . getLocale(),'hex_code')->get();
        $relatedImages = $car->images;
        $tags   = Tag::select('id','name_' . getLocale() )->get();
        $carvideoId = $car->video_url;
        $this->getYoutubeVideoUrl($carvideoId);
        $fullYoutubeUrl = ($carvideoId) ? $this->getYoutubeVideoUrl($carvideoId) : null;

        $selectedtagsIds = $car->tags->pluck('id')->toArray();
         
 


         return view('dashboard.cars.edit',compact('brands','colors','car','models','cities','categories','relatedImages','tags','selectedtagsIds','fullYoutubeUrl'));
    }

    public function validateStep( Request $request , Car $car = null)
    {
        $discountPrice = $request['discount_price'] ?? 0;
            $price         = $request['price'] ?? 0;
            $status= $request['status']?? 1;
            $isVendor = Auth::guard('vendor')->check();
        if($isVendor){
            $request->validate([
                'brand_id' => ['required'],
                'model_id' => ['required'],
                'description_ar'=>['required','string',new NotNumbersOnly()],
                'description_en'=>['string',new NotNumbersOnly()],
                'category_id' => ['nullable'],
                'name_ar' => ['required' , 'string','max:255',new NotNumbersOnly()],
                'name_en' => [ 'nullable' , 'string','max:255',new NotNumbersOnly()],
                'year' => ['required'],
                'fuel_type' => ['required'],
                'publish' => ['required'],
                'gear_shifter' => ['required'],
                'video_url' => ['nullable' , 'string','url'],
                'price' => 'required | numeric|lte:2147483647|not_in:0|gt:' . $discountPrice,
                'discount_price' => 'required_with:have_discount|nullable|numeric|not_in:0|lt:' . $price,
                'supplier' => ['required','in:gulf,saudi'],
                'status' => 'required',
                'is_new' => ['required'],
                'show_in_home_page' => ['required', 'in:0,1'],
                'kilometers' => ['required_if:is_new,0', 'numeric', 'nullable', 'min:0'],
                'color_id'=>['required'],
                'city_id'=>['required'],
                'fuel_tank_capacity' => 'required|string|max:255' ,
                'car_body'          => 'required|string' ,
                // 'car_Images'    => ['required','array','min:2','max:5'],
            ]);
        }else{
            $request->validate([
                'brand_id' => ['required'],
                'model_id' => ['required'],
                'description_ar'=>['required','string',new NotNumbersOnly()],
                'description_en'=>['required','string',new NotNumbersOnly()],
                'category_id' => ['nullable'],
                'name_ar' => ['required' , 'string','max:255',new NotNumbersOnly()],
                'name_en' => ['required' , 'string','max:255',new NotNumbersOnly()],
                'year' => ['required'],
                'fuel_type' => ['required'],
                'publish' => ['required'],
                'gear_shifter' => ['required'],
                'video_url' => ['nullable' , 'string','url'],
                'price' => 'required | numeric|lte:2147483647|not_in:0|gt:' . $discountPrice,
                'discount_price' => 'required_with:have_discount|nullable|numeric|not_in:0|lt:' . $price,
                'supplier' => ['required','in:gulf,saudi'],
                'status' => 'required',
                'is_new' => ['required'],
                'show_in_home_page' => ['required', 'in:0,1'],
                'kilometers' => ['required_if:is_new,0', 'numeric', 'nullable', 'min:0'],
                'color_id'=>['required'],
                'city_id'=>['required'],
                'fuel_tank_capacity' => 'required|string|max:255' ,
                'car_body'          => 'required|string' ,
                // 'car_Images'    => ['required','array','min:2','max:5'],
            ]);
        }


             if( $car )
            {
                
                if ( ! $request['is_duplicate'] )
                {

                    $request['is_duplicate']=0;

                    $this->update( $request , $car);
                }else
                {
                     ! $request->hasFile('car_Images')  ? $request['car_Images']  = $car['car_Images']  : null;
                    $this->store( $request ) ;
                }

            }else
            {

                $this->store( $request );
            }
        
          } 

    public function store(Request $request)
    { 
       $this->authorize('create_cars');
        if(!$request['is_duplicate']){
            $request->validate([
                'car_Images'    => ['required','array','max:15'],
                // 'car_Images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048', // Adjust allowed image types and size as neede
            ]);
        }
        else{

        }
   
        $request['vendor_id'] = Auth::user()->id??null;
        $data                      = $request->except('car_Images','deleted_images','car_id','tags');
        $data['have_discount']     = $request['have_discount'] === "on";
        // $data['price'] = $this->getPriceFieldValue( $data );
        if ($request->file('car_Images')){
             $images=$this->uploadCarImages($request->file('car_Images'));
            // $data['images'] =  uploadImage( $request->file('images') , "Cars");
         }

         $data['video_url']=$this->getYoutubeVideoId($request['video_url']);

        //   $this->setCarName($data);
         $car = Car::create($data);
 
         $this->storeBrandCarsTypeCount($data['is_new'], $data['brand_id']);
         $car->tags()->attach( $request['tags'] ?? [] );

         if ($request->file('car_Images')){
            foreach( $images as $image){
             $imageData=[
                'car_id'=>$car->id,
                'image'=>$image,
            ];
            CarImage::create($imageData);
        }
        $car->main_image=$car->images[0]->image;
        $car->save();
     }
     if($request->is_duplicate){
        $carold=Car::find($request->car_id);
        $oldImages=$carold->images;
        $imageNames = [];
        $deletedImages=$deletedImages = json_decode(request()->deleted_images ?? "[]");
        $countcarimages=count($oldImages);
        if($request->car_Images){
            $newcarsimages=count($request->car_Images);

        }else{
            $newcarsimages=0;
        }
        $result=$countcarimages-count($deletedImages);

        if((count($deletedImages)==$countcarimages || ($countcarimages==0&&$newcarsimages==1))||$countcarimages==0){
            $request->validate([
                'car_Images'    => ['required','array','max:15',new ValidateMaxImages($carold,$deletedImages)],
                'car_Images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048', // Adjust allowed image types and size as neede
            ]);
 
          }
        foreach ($oldImages as $imageEntry) {
            $imageNames[] = $imageEntry["image"];
        }
        $filteredImages = [];
        foreach ($imageNames as $imageName) {
            if (!in_array($imageName, $deletedImages)) {
                $filteredImages[] = $imageName;
            }
        }
        $allnewfiles=[];
         foreach ($filteredImages as $imageName) {
             $file=  getImagePathFromDirectory($imageName,'Cars');
             $fileContent=file_get_contents($file);
            $tempFilePath = tempnam(sys_get_temp_dir(), 'temp_file');
            $rr=file_put_contents($tempFilePath, $fileContent);
 
            $uploadedFile = UploadedFile::createFromBase(
                new \Symfony\Component\HttpFoundation\File\UploadedFile(
                    $tempFilePath,
                    $imageName, // Use the original file name here
                    mime_content_type($tempFilePath),
                    null,
                    true
                )
            );
            $allnewfiles['car_Images']=$uploadedFile;

             $originalName =  $uploadedFile->getClientOriginalName(); // Get file Original Name

             $imageData=[
                'car_id'=>$car->id,
                'image'=>$originalName,
            ];
             CarImage::create($imageData);
        }
        $car->main_image=$car->images[0]->image;
        $car->save();
        $images=$this->uploadCarImages($allnewfiles);

     }  
    }
    public function update(Request $request , Car $car)
    {
          $this->authorize('update_cars');
 
         $data                      = $request->except('car_Images','deleted_images','car_id','tags');
         $data['have_discount']     = $request['have_discount'] === "on";

          $deletedImages = json_decode(request()->deleted_images ?? "[]");
        if($request->car_Images){
            $newcarsimages=count($request->car_Images);
        }
          
          $countcarimages=CarImage::where('car_id',$car->id)->count();
          $request->validate([
            'car_Images'    => [new ValidateMaxImages($car,$deletedImages)],
            'car_Images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048', // Adjust allowed image types and size as neede
        ]);
        $result=$countcarimages-count($deletedImages);
          if((count($deletedImages)==$countcarimages || ($countcarimages==0&&$newcarsimages==1))||$countcarimages==0){
            $request->validate([
                'car_Images'    => ['required','array','max:15'],
                'car_Images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048', // Adjust allowed image types and size as neede
            ]);
          }
         
          $data['video_url']=$this->getYoutubeVideoId($request['video_url']);

        // $this->setCarName($data);

        $carOldType = $car['is_new'];
        $carOldBrandId = $car['brand_id'];
 
        $car->update($data);
         CarImage::handleProductImages($car->id);
         $car->tags()->sync( $request['tags'] ?? [] );

        if(isset($car->images[0])){
            $car->main_image=$car->images[0]->image;
            $car->save();
            }else{
            $car->main_image="";
            $car->save();
            }
            
            
        if( $carOldBrandId == $data['brand_id'] )
        {
            $this->updateBrandCarsTypeCount(action: 'update', oldCarType:$carOldType, currentBrandId: $data['brand_id'], newCarType: $data['is_new']);
        }
        else
            $this->updateBrandCarsTypeCount('update', $carOldType, $carOldBrandId, $data['brand_id'], newCarType: $data['is_new']);

    }
public function show(Car $car){
    $car->load('color');
    $models = CarModel::select('id','name_' . getLocale())->get();
    $brands = Brand::select('id','name_' . getLocale())->get();
    $cities = City::select('id','name_' . getLocale())->get();
    $categories=Category::select('id','name_' . getLocale())->get();
    $tags   = Tag::select('id','name_' . getLocale() )->get();
    $selectedtagsIds = $car->tags->pluck('id')->toArray();

    $colors = Color::select('id','image','name_' . getLocale(),'hex_code')->get();
    
    $relatedImages = $car->images;
    return view('dashboard.cars.show',compact('brands','colors','car','models','cities','categories','relatedImages','tags','selectedtagsIds'));
}
    // private  function cleanColorsArray($colors , $oldCarColorImages)
    // {
    //     return array_filter( $colors , fn ($color) => ( $color['inner_images'] ?? false ) || ( $color['outer_images'] ?? false ) || array_key_exists( $color['id'] ,$oldCarColorImages ));
    // }


    public function images(Car $car){
        $carImages = $car->images->toArray();
        $images =  scandir(public_path('/storage/Images/Cars'));
 
        foreach ( $carImages as $imageName )
        {          
            $imageName = $imageName['image'];
            if (in_array($imageName, $images)) {
                $image['image'] = $imageName;
                $filePath = public_path("/storage/Images/Cars/$imageName");
                $image['size'] = filesize($filePath);
                $image['path'] = asset("/storage/Images/Cars/$imageName");
                $data[] = $image;
            }
        }

        return response()->json($data);
    }
    private function setCarName(&$data)
    {
        $brand    = Brand::find( $data['brand_id'] , ['id','name_ar','name_en']);
        $model    = CarModel::find( $data['model_id'] , ['id','name_ar','name_en']);
        $data['name_ar'] = $brand->name_ar . ' ' . $model->name_ar. ' ' . $data['year'];
        $data['name_en'] = $brand->name_en . ' ' . $model->name_en. ' ' .  $data['year'];
    }
    public function getModels($brandId)
    {
          $models = CarModel::where('brand_id', $brandId)->get();
         return response()->json($models);
    }  

    public function getCategories($modelId)
    {
        $categories = Category::where('car_model_id', $modelId)->get();
        
         return response()->json($categories);
    }  

    private function uploadCarImages( $images )
    {
        $imagesNames = [];

        foreach ( $images as $index => $image )
        {
            $imagesNames[$index] = uploadImage( $image , "Cars");
        }

        return $imagesNames;
    }

    private function getPriceFieldValue($data) : string
    {
        if(array_key_exists('discount_price',$data)) $value =  "<h6 class='price-before'> <span>".$data['price']."</span> <span class='currency-value' ></span> </h6>
        <h6 class='price-now'> <span class='price-word' ></span>". $data['discount_price'] ."<span class='currency-value' ></span> </h6>";
        else $value =  "<h6 class='price-before'></h6>
        <h6 class='price-now'> <span class='price-word' > </span>". $data['price'] ."<span class='currency-value' ></span> </h6>";
      
        return $value;

    }

    public function destroy(Request $request , Car $car)
    {
        $this->authorize('delete_cars');

        if ($request->ajax())
        {
            $car->delete();
            $this->updateBrandCarsTypeCount('deletion', $car->is_new, $car->brand_id);
        }

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

    private function updateBrandCarsTypeCount($action, $oldCarType, $currentBrandId, $newBrandId = null, $newCarType = null)
    {
         $currentBrand = Brand::find($currentBrandId);
        $currentBrandNewCarsCount = $currentBrand->newCars->count();
        $currentBrandUsedCarsCount = $currentBrand->oldCars->count();

        if(!$newBrandId) // deletion and update carType only
        {
            if($action == 'deletion')
            {
                if($oldCarType == 1) // car is new
                {
                    if($currentBrandNewCarsCount == 0) // delete last new car case
                    {
                        if($currentBrand->car_available_types == 'both')
                            $currentBrand->update(['car_available_types' => 'used']);
                        else $currentBrand->update(['car_available_types' => null]);
                    }
                }
                else // car is used
                {
                    if ($currentBrandUsedCarsCount == 0) // delete last used car case
                    {
                        if ($currentBrand->car_available_types == 'both')
                            $currentBrand->update(['car_available_types' => 'new']);
                        else $currentBrand->update(['car_available_types' => null]);
                    }
                }
            }
            else
            {
                if($oldCarType == 1 && $newCarType == 0) // change from new to used
                {
                    if($currentBrandUsedCarsCount == 1)
                    {
                        if($currentBrandNewCarsCount > 0)
                        {
                            if($currentBrand->car_available_types == 'new')
                                $currentBrand->update(['car_available_types' => 'both']);
                        }
                        else $currentBrand->update(['car_available_types' => 'used']);
                    }
                }
                else if($oldCarType == 0 && $newCarType == 1) // change from used to new
                {
                     if ($currentBrandNewCarsCount == 1)
                    {
                        if($currentBrandUsedCarsCount > 0)
                        {
                            if ($currentBrand->car_available_types == 'used')
                                $currentBrand->update(['car_available_types' => 'both']);
                        }
                        else $currentBrand->update(['car_available_types' => 'new']);
                    }
                }
            }
        }
        else // update brand or brand and type
        {
             $newBrand = Brand::find($newBrandId);
            $newBrandNewCarsCount = $newBrand->newCars->count();
            $newBrandUsedCarsCount = $newBrand->oldCars->count();

            if($oldCarType == 1 && $newCarType == 0) // change from new to used
            {
                // dd("new to used", $currentBrandNewCarsCount, $newBrandUsedCarsCount);
                if($currentBrandNewCarsCount == 0)
                {
                    switch ($currentBrand->car_available_types)
                    {
                        case 'both':
                            $currentBrand->update(['car_available_types' => 'used']);
                            break;
                        case 'new':
                            $currentBrand->update(['car_available_types' => null]);
                            break;
                    }
                }

                if($newBrandUsedCarsCount == 1)
                {
                    switch ($newBrand->car_available_types)
                    {
                        case 'new':
                            $newBrand->update(['car_available_types' => 'both']);
                            break;
                        case null:
                            $newBrand->update(['car_available_types' => 'used']);
                            break;
                    }
                }

            }
            else if($oldCarType == 1 && $newCarType == 1) // change from new to new
            {
                // dd("new to new", $currentBrandNewCarsCount, $newBrandNewCarsCount);
                echo("new to new ". $currentBrandNewCarsCount. $newBrandNewCarsCount);
                if($currentBrandNewCarsCount == 0)
                {
                    switch ($currentBrand->car_available_types)
                    {
                        case 'both':
                            $currentBrand->update(['car_available_types' => 'used']);
                            break;
                        case 'new':
                            $currentBrand->update(['car_available_types' => null]);
                            break;
                    }
                }

                if($newBrandNewCarsCount == 1)
                {
                    switch ($newBrand->car_available_types)
                    {
                        case 'used':
                            $newBrand->update(['car_available_types' => 'both']);
                            break;
                        case null:
                            $newBrand->update(['car_available_types' => 'new']);
                            break;
                    }
                }
            }
            else if($oldCarType == 0 && $newCarType == 0) // change from used to used
            {
                // dd("used to used", $currentBrandUsedCarsCount, $newBrandUsedCarsCount);
                if($currentBrandUsedCarsCount == 0)
                {
                    switch ($currentBrand->car_available_types)
                    {
                        case 'both':
                            $currentBrand->update(['car_available_types' => 'new']);
                            break;
                        case 'used':
                            $currentBrand->update(['car_available_types' => null]);
                            break;
                    }
                }

                if($newBrandUsedCarsCount == 1)
                {
                    switch ($newBrand->car_available_types)
                    {
                        case 'new':
                            $newBrand->update(['car_available_types' => 'both']);
                            break;
                        case null:
                            $newBrand->update(['car_available_types' => 'used']);
                            break;
                    }
                }
            }
            else if($oldCarType == 0 && $newCarType == 1) // change from used to new
            {
                // dd("used to new", $currentBrandUsedCarsCount, $newBrandNewCarsCount);
                if($currentBrandUsedCarsCount == 0)
                {
                    switch ($currentBrand->car_available_types)
                    {
                        case 'both':
                            $currentBrand->update(['car_available_types' => 'new']);
                            break;
                        case 'used':
                            $currentBrand->update(['car_available_types' => null]);
                            break;
                    }
                }

                if($newBrandNewCarsCount == 1)
                {
                    switch ($newBrand->car_available_types)
                    {
                        case 'used':
                            $newBrand->update(['car_available_types' => 'both']);
                            break;
                        case null:
                            $newBrand->update(['car_available_types' => 'new']);
                            break;
                    }
                }
            }
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
    protected function getYoutubeVideoUrl($videoId)
    {
    // Use a regular expression to extract the video ID from the YouTube URL
    $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
     // Check if the URL matches the pattern
   
        // Return the full YouTube URL
        return 'https://www.youtube.com/watch?v=' .$videoId;
    

    // Return null if no match is found

    }

}
