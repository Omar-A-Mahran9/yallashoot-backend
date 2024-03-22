<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranResourse;
use App\Http\Resources\CarResourse;
use App\Http\Resources\ColorResourse;
use App\Http\Resources\ModelResourse;
use App\Models\Bank;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Nationality;
use App\Models\Order;
use App\Models\Organizationactive;
use App\Models\OrganizationType;
use App\Models\Sector;
use App\Models\Tag;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class CarController extends Controller
{
   
    public function carsdetails(){
        
        $cars=Car::get();
        $data=CarResourse::collection( $cars );
        return $this->success(data: $data);

    }
    public function cardetails($id){
        $car=Car::findOrFail($id);
        $car->increment('viewers');
        $related = Car::where('brand_id', $car->brand_id)
         ->where('id', '!=', $car->id) 
         ->take(10) 
         ->get();
         $related_car=CarResourse::collection( $related );

        $car->related_cars = $related_car;
        $data = CarResourse::make($car)->resolve();

        return $this->success(data: ['carDetails'=>$data,'Relatedcars'=>$related_car]);
  
    }

    public function cartype(){
        $data=[
            'New'=>1,
            'Old'=>0
        ];
        return $this->success(data: $data);
    }


    public function carmodel(){
        $model=CarModel::get();
        $data=ModelResourse::collection( $model );
        return $this->success(data: $data);
    }

    public function CarOption(){
        $organizationTypes = OrganizationType::get();
        $type = $organizationTypes->map(function ($organizationType) {
            return [
                'id' => $organizationType->id,
                'title' => $organizationType->title,
            ];
        })->toArray();

        $organizationActives = Organizationactive::get();
        $Active = $organizationActives->map(function ($organizationActive) {
             return [
                'id' => $organizationActive->id,
                'title' => $organizationActive->title,
            ];
        })->toArray();

        $cars=Car::get();
        $maxPrice = $cars->max('price');
        $minPrice = $cars->min('price');
        $brands = Brand::select('id','image','name_en','name_ar', 'car_available_types' )->has('cars')->whereHas('models.cars')->whereNotNull('car_available_types')->get();
        $allbrands = Brand::select('id','image','name_en','name_ar', 'car_available_types' )->get();
        $color=Color::get(); 
        $model=CarModel::has('cars')->get();
        $ModelData=ModelResourse::collection( $model );
        $ColorData = ColorResourse::collection( $color);
        $BrandData = BranResourse::collection( $brands );
        $BrandsData = BranResourse::collection( $allbrands );
        $nationality = Nationality::get();
        $city=City::get();
        $category=Category::get();
        $tags=Tag::get();

        $tagss = $tags->map(function ($tags) {
            return [
                'id' => $tags->id,
                'title' => $tags->name,
            ];
        })->toArray();

        $nationalitydata = $nationality->map(function ($nationality) {
            return [
                'id' => $nationality->id,
                'title' => $nationality->name,
            ];
        })->toArray();

        $citydata = $city->map(function ($city) {
            return [
                'id' => $city->id,
                'title' => $city->name,
            ];
        })->toArray();
        $categorydata = $category->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category->name,
            ];
        })->toArray();

          $years = Car::distinct()->pluck('year')->sortBy(function ($year) {
            return (int) $year;
        })->values()->toArray();     

////////
        $car=Car::get();
        $currentYear = now()->year;
        $yearsRange = range(2010, $currentYear);
        $carCountsPerYear = [];

        foreach ($yearsRange as $year) {
            $count = Car::where('year', $year)->count();
            $carCountsPerYear[] = [
                'year' => $year,
                'count' => $count,
            ];
        }
         $usedCount = $car->where('is_new', '0')->count();
        $newCount = $car->where('is_new', '1')->count();
        $automatic_gear = $car->where('gear_shifter', 'automatic')->count();
        $manual_gear = $car->where('gear_shifter', 'manual')->count();
        $gasoline_type = $car->where('fuel_type', 'gasoline')->count();
        $diesel_type = $car->where('fuel_type', 'diesel')->count();
        $electric_type = $car->where('fuel_type', 'electric')->count();
        $hybrid_type = $car->where('fuel_type', 'hybrid')->count();

        $hatchback_shape = $car->where('car_body', 'hatchback')->count();
        $sedan_shape = $car->where('car_body', 'sedan')->count();
        $four_wheel_drive_shape = $car->where('car_body', 'four-wheel-drive')->count();
        $commercial_shape = $car->where('car_body', 'commercial')->count();
        $family_shape = $car->where('car_body', 'family')->count();

        $ranges = [
            0 => [800, 1200],
            1 => [1300, 1400],
            2 => [1500, 1600],
            3 => [1800, 2000],
            4 => [2200, 3000],
            5 => 'greater_than_3000', // Special case for > 3000
        ];
        
        $fuel_tank_capacity_results = [];
        
        foreach ($ranges as $index => $range) {
            // For each range, we'll count the cars that fit the criteria
            if ($range === 'greater_than_3000') {
                $count = Car::where('fuel_tank_capacity', '>', 3000)->count();
                $title = 'More than 3000';
            } else {
                $count = Car::whereBetween('fuel_tank_capacity', $range)->count();
                $title = "{$range[0]} - {$range[1]}";
            }
        
            $fuel_tank_capacity_results[] = [
                'title' => $title,
                'car_count' => $count,
            ];
        }
 
        $data = [
            'brands' => $BrandData,
            'allbrands'=>$BrandsData,
            'colors' => $ColorData,
            'models'=> $ModelData,
            'gear_shifter'=>[
                'manual',
                'automatic'
            ],
            'statue'=>[
                1=>'New',
                0=>'Used'
            ],
            'fuel_type'=>[
                'gasoline', 'diesel', 'electric', 'hybrid'
            ],
            'supplier'=>[
                'gulf', 'saudi'
            ],
            'supplier_english'=>[
                'gulf', 'saudi'
            ],
            'tags'=> $tagss ,
            'Slider'=>[
                'maxPrice'=>$maxPrice,
                'minPrice'=>$minPrice
            ],
            'Car_style'=>[
                'hatchback', 'sedan', 'four-wheel-drive', 'commercial','family'
            ],
            'Category'=>$categorydata,
            'City'=>$citydata,
            'sectors'=>Sector::get()->toArray(),
            'banks'=>Bank::where('type','bank')->get()->toArray(),
            'year'=>$years,
            
            'OrganizationType'=> $type,
            'OrganizationActive'=>$Active,
            'nationalities'=> $nationalitydata,
            'car_counts'=>[
                'used' => $usedCount,
                'new' => $newCount,
                'automatic'=>$automatic_gear,
                'manual'=>$manual_gear,
                'gasoline_type'=>$gasoline_type,
                'diesel_type'=>$diesel_type,
                'electric_type'=>$electric_type,
                'hybrid_type'=>$hybrid_type,
                'hatchback_shape'=>$hatchback_shape,
                'sedan_shape'=>$sedan_shape,
                'four_wheel_drive_shape'=>$four_wheel_drive_shape,
                'commercial_shape'=>$commercial_shape,
                'family_shape'=>$family_shape,
                'years'=> $carCountsPerYear,
                'fuel_capacity'=>$fuel_tank_capacity_results,



            ]

           
        ];
        return $this->success(data: $data);
    }


    public function filter(){
        if (request()->has('search')) {
             $searchKeyword = request()->input('search');
             $query = Car::query();
     
            $query->where(function ($query) use ($searchKeyword) {
                $query->where('name_ar', 'LIKE', "%$searchKeyword%")
                ->orWhere('name_en', 'LIKE', "%$searchKeyword%")->orWhere('description_ar','LIKE', "%$searchKeyword%")->orWhere('description_en', "%$searchKeyword%");
            });
    
            if ($searchKeyword) {
                $query->with('brand')->orWhereHas('brand', function ($brandQuery) use ($searchKeyword) {
                    $brandQuery->where('name_ar', 'LIKE', "%$searchKeyword%")->orWhere('name_en','LIKE',"%$searchKeyword%")->orWhere('meta_desc_en','LIKE', "%$searchKeyword%")->orWhere('meta_keyword_ar', "%$searchKeyword%")->orWhere('meta_keyword_ar', "%$searchKeyword%");
                });
            }
        
            if ($searchKeyword) {
                $query->with('model')->orWhereHas('model', function ($modelQuery) use ($searchKeyword) {
                    $modelQuery->where('name_ar', 'LIKE', "%$searchKeyword%")->orWhere('name_en','LIKE',"%$searchKeyword%")->orWhere('meta_keyword_ar','LIKE',"%$searchKeyword%")->orWhere('meta_keyword_en','LIKE',"%$searchKeyword%")->orWhere('meta_desc_ar','LIKE',"%$searchKeyword%");
                });
            }
    
            $perPage = 9; 
            $cars = $query->paginate($perPage);
            $data=CarResourse::collection( $cars );
    
            return $this->successWithPagination(message:"All Pagination Car",data: $data);
        } else {
        
        try{
            $tab = request('tag');
            $type = request('type',[]);
            $gear_shifters = request('gear_shifters', []);
            $fuel_types = request('fuel_types', []);
            $car_bodies = request('car_body', []);
            $color_ids = request('color_id', []);
            $years = request('year', []);
            $model_ids = request('model_id', []);
            $minPrice = request('min_price');
            $maxPrice = request('max_price');
            $color_ids = request('color_id', []);
    
            $fuel_tank_capacities = request('fuel_tank_capacities', []);
            $brand_ids = request('brand_id', []);

            $query = Car::query()->where('show_in_home_page', 1);

             //best Selling car
             $query->when($tab, function ($q, $tab) {
                $tag = Tag::with('cars')->find($tab);
              
                if ($tag) {
                    $carIds = $tag->cars->pluck('id')->toArray();
                    return $q->whereIn('id', $carIds);
                }
                
                 });

            $query->when(!empty($type), function ($q) use ($type) { 
                if (in_array('all', $type)) {
                    return $q;
                } else {
                    return $q->whereIn('is_new', $type);
                }    
               
            });
    

            //gearshifter
            $query->when(!empty($gear_shifters), function ($q) use ($gear_shifters) {
                if (in_array('all', $gear_shifters)) {
                    return $q;
                } else {
                    return $q->whereIn('gear_shifter', $gear_shifters);
                }   
            });

            //fuel_type
            $query->when(!empty($fuel_types), function ($q) use ($fuel_types) {

                if (in_array('all', $fuel_types)) {
                    return $q;
                } else {
                    return $q->whereIn('fuel_type', $fuel_types);
                }   

            });

            
                    // Car bodies with multiple values
            $query->when(!empty($car_bodies), function ($q) use ($car_bodies) {
                if (in_array('all', $car_bodies)) {
                    return $q;
                } else {
                    return $q->whereIn('car_body', $car_bodies);
                }    
                });

                // Color IDs with multiple values
            $query->when(!empty($color_ids), function ($q) use ($color_ids) {
                if (in_array('all', $color_ids)) {
                    return $q;
                } else {
                    return $q->whereIn('color_id', $color_ids);
                }    
                });
               
                // Years with multiple values
            $query->when(!empty($years), function ($q) use ($years) {
                
                if (in_array('all', $years)) {
                    return $q;
                } else {
                    foreach ($years as $year) {
                        if($year==1){
                           return $q->where(function ($query) use ($years) {
                               $query->where('year', '<', 2010)
                                   ->orWhereIn('year', $years);
                           });
                       }
                       return $q->whereIn('year', $years);
       
                   }
                }    
                });

              
         
                // Model IDs with multiple values
            $query->when(!empty($model_ids), function ($q) use ($model_ids) {
                if (in_array('all', $model_ids)) {
                    return $q;
                } else {
                    return $q->whereIn('model_id', $model_ids);
                }  
                });

                //brand_id
            $query->when(!empty($brand_ids), function ($q) use ($brand_ids) {
                if (in_array('all', $brand_ids)) {
                    return $q;
                } else {
                    return $q->whereIn('brand_id', $brand_ids);
                } 
            });

            // Price Range
            $query->when(isset($minPrice), function ($q) use ($minPrice) {
                return $q->where('price', '>=', $minPrice);
            })->when(isset($maxPrice), function ($q) use ($maxPrice) {
                return $q->where('price', '<=', $maxPrice);
            });

            $query->when('fuel_tank_capacity', function ($q) use ($fuel_tank_capacities) {
                if (in_array('all', $fuel_tank_capacities)) {
                    return $q;
                } else {
                    foreach ($fuel_tank_capacities as $choice) {
                        switch ($choice) {
                            case 0:
                                $q->orWhereBetween('fuel_tank_capacity', [800, 1200]);
                                break;
                            case 1:
                                $q->orWhereBetween('fuel_tank_capacity', [1300, 1400]);
                                break;
                            case 2:
                                $q->orWhereBetween('fuel_tank_capacity', [1500, 1600]);
                                break;
                            case 3:
                                $q->orWhereBetween('fuel_tank_capacity', [1800, 2000]);
                                break;
                            case 4:
                                $q->orWhereBetween('fuel_tank_capacity', [2200, 3000]);
                                break;
                            case 5:
                                 $q->where('fuel_tank_capacity', '>', 3000);
                                 break;
                            default:
                                 $q->WhereBetween('fuel_tank_capacity', [0, 3000]);
                                break;
    
    
                            // $query->orWhereBetween('fuel_tank_capacity', [0, 3000]);
                        }
                    }
                } 
                
            });


            $perPage = 9; 
            $que = $query->paginate($perPage);
            $data=CarResourse::collection( $que );
            return $this->successWithPagination(message:"Cars per page",data: $data);

            }
        catch (\Exception $e){
                return $this->failure(message: $e->getMessage());
            }

        }

    }



}
