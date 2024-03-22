<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\City;
use App\View\Components\web\CarComponent;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class CarController extends Controller
{
    public function index(Request $request)
    {

        $cities = City::with('branches')->get();
        $selectedBrand = [
            'name_ar' => '',
            'name_en' => '',
        ];;
        if ( ! isset($request['page']) )
        {
            $cars    = Car::query()->select( Car::$carCardColumns )->orderby('created_at','desc')->with('brand:id,name_ar');
            $perPage = 4;

            if($request->name)
            {
                $cars = $cars->where('name_ar', 'LIKE', '%' . $request->name .'%')->orWhere('name_en', 'LIKE', '%' . $request->name .'%');

                if($cars->count() == 0)
                {
                    return view('web.unavailable-car', compact('cities'));
                }
            }
            else
            {
                $priceFrom = $request['price_from'] - ($request['price_from'] * (settings()->getSettings('tax') / 100));

                $cars = $cars->when($request['type']        != null  , fn( $car ) => $car->where('is_new'        , '='  , $request['type'] == 'new') );
                $cars = $cars->when($request['brand_name']   != null  , function( $car ) use ( $request , &$selectedBrand) {
                    $brand = Brand::where('name_ar', 'LIKE', '%' . $request['brand_name'] .'%')->orWhere('name_en', 'LIKE', '%' . $request['brand_name'] .'%')->first();
                    $selectedBrand = [
                        'name_ar' => $brand->name_ar,
                        'name_en' => $brand->name_en
                    ];
                    return $car->where('brand_id' , '='  , $brand->id);
                } );
                $cars = $cars->when($request['model_id']     != null  , fn( $car ) => $car->where('model_id'     , '='  , $request['model_id']));
                $cars = $cars->when($request['sub_model_id'] != null  , fn( $car ) => $car->where('sub_model_id' , '='  , $request['sub_model_id']));
                $cars = $cars->when(! is_null($request['price_from']) || ! is_null($request['price_to'])  , function( $car ) use ( $request , $priceFrom )  {
                    return $car->where(function($query) use ( $priceFrom , $priceTo ) {
                        $query->whereBetween('price' , [ ($priceFrom ?? 0) , $priceTo ])->OrwhereBetween('discount_price' , [ ($priceFrom ?? 0) , $priceTo ]);
                    });
                });
            }

            $isThereMoreCars = $cars->count() - ( ( $request['cars_count'] ?? 0 ) + $perPage ) > 0;
            $cars            = $cars->skip( $request['cars_count'] ?? 0 )->take( $perPage )->get();


            if ( $request->ajax() )
            {
                $carsHtml  = "";
                foreach ( $cars as $car )
                $carsHtml .= view('components.web.car-component', compact('car'))->render();

                return response()->json(['cars' => $carsHtml , 'is_there_more' => $isThereMoreCars ]);
            }

            return view('web.cars', compact('cities', 'selectedBrand'));

        }else
        {
            return view('web.brands');
        }

    }
    public function show($id)
    {
        $car                            = Car::findOrFail($id);
        $brand                          = Brand::select('name_'.getLocale())->where('id', $car->brand_id)->first();
        $similarVehicles                = Car::select( Car::$carCardColumns)->where('brand_id', $car->brand_id)->where('id','!=', $car->id)->orderBy('year', 'desc')->limit(3)->get();
        [ $specifications , $features ] = $this->getSpecificationsAndFeatures($car);

        return view('web.car', compact('car', 'brand', 'similarVehicles','specifications','features'));
    }

    private function getSpecificationsAndFeatures(Car $car)
    {

        $drivingMode = array_map(function($mode){
            return __($mode);
        },json_decode($car['driving_mode']));
        $drivingMode = implode(" , ",$drivingMode);
        $specifications = [
            [
                "name"   => __('Engine Specifications'),
                "image"  => "web/img/Engine Specifications.png",
                "values" => collect([
                [ 'name' => __('Engine Measurement') , 'value' => $car['engine_measurement'] ],
                [ 'name' => __('Engine type') , 'value' => $car['engine_type']],
                [ 'name' => __('turbo') , 'value' => $car['turbo']],
                [ 'name' => __('Engine system') , 'value' => $car['engine_system']],
                [ 'name' => __('valves') , 'value' => $car['valves']],
                [ 'name' => __('determination') , 'value' => $car['determination']],
                [ 'name' => __('fuel consumption in liters') , 'value' => $car['fuel_consumption'] . ' ' . __('Liter')],
            ])],
            [
                "name"   => __('Transmission'),
                "image"  => "web/img/Transmission.png",
                "values" => collect([
                    [ 'name' => __('Motion vector') , 'value' => $car['Motion_vector']],
                    [ 'name' => __('Shifters on the steering wheel') , 'value' => $car['wheel_shifters']],
                    [ 'name' => __('traction type') , 'value' => $car['traction_type']],
                    [ 'name' => __('driving mode') , 'value' => $drivingMode],
            ])],
            [
                "name"   => __('Measurements'),
                "image"  => "web/img/Measurements.png",
                "values" => collect([
                    [ 'name' => __('maximum force') , 'value' => $car['maximum_force']],
                    [ 'name' => __('fuel tank capacity') , 'value' => $car['fuel_tank_capacity'] . ' ' . __('Liter')],
                    [ 'name' => __('EcoBoost') , 'value' => $car['eco_boost']],
            ])],
            [
                "name"   => __('Skeleton'),
                "image"  => "web/img/Skeleton.png",
                "values" => collect([
                    [ 'name' => __('Number of seats') , 'value' => $car['seats_number']],
                    [ 'name' => __('number of speakers') , 'value' => $car['speakers_number']],
                    [ 'name' => __('steering wheel') , 'value' => $car['steering_wheel']],
                    [ 'name' => __('car style') , 'value' => $car['car_style']],
                    [ 'name' => __('wheels') , 'value' => $car['wheels']],
            ])],
        ];

        $features       = collect([
            [
                "name" => __('External Equipment'),
                "image"  => "web/img/External Equipment.png",
                "features" => collect([
                    $car['bright_lights_during_the_day'] != 'unavailable' ?  __('Bright lights during the day') . ' : ' . __($car['bright_lights_during_the_day']) : null,
                    $car['fog_lights']                   != 'unavailable' ?  __('fog lights') . ' : ' . __($car['fog_lights']) : null,
                    $car['headlights']                   != null          ?  __('headlights') . ' : ' . __($car['headlights']) : null,
                    $car['smart_entry_system']           == 1             ?  __('Smart Entry System')             : null,
                    $car['chrome_door_handles']          == 1             ?  __('Chrome door handles')            : null,
                    $car['rear_parking_sensors']         == 1             ?  __('Rear parking sensors')           : null,
                    $car['front_parking_sensors']        == 1             ?  __('Front parking sensors')          : null,
                    $car['one_touch_electric_sunroof']   == 1             ?  __('One-touch electric sunroof')     : null,
                    $car['electrical_side_mirrors']      == 1             ?  __('Electric side mirrors')          : null,
                    $car['chrome_side_mirrors']          == 1             ?  __('Chrome side mirrors')            : null,
                    $car['automatic_trunk_door']         == 1             ?  __('automatic trunk door')           : null,
                    $car['led_backlight_lights']         == 1             ?  __('LED tail lights')                : null,
                    $car['rear_suite']                   == 1             ?  __('rear spoiler')                   : null,
                    $car['panorama_roof']                == 1             ?  __('panoramic roof')                 : null,
            ])->whereNotNull()->values()],
            [
                "name" => __('Ease and comfort'),
                "image"  => "web/img/Ease and comfort.png",
                "features" => collect([
                    $car['remote_engine_start']    == 1  ?  __('Remote engine start') : null,
                    $car['electric_hand_brakes']   == 1  ?  __('Electric hand brake') : null,
                    $car['ac_in_second_row_seats'] == 1  ?  __('Air conditioning vents in the back') : null,
                    $car['engine_start_button']    == 1  ?  __('Engine start button') : null,
                    $car['cruise_control']         == 1  ?  __('cruise control') : null,
                    $car['leather_steering_wheel'] == 1  ?  __('Leather steering wheel') : null,
            ])->whereNotNull()->values()],
            [
                "name" => __('Seats'),
                "image"  => "web/img/Seats.png",
                "features" => collect([
                    $car['upholstered_seats']       != null  ?  __('Seat upholstery') . ' : ' . __($car['upholstered_seats']): null,
                    $car['driver_seat_adjustment']  != null  ?  __('Driver seat adjustment') . ' : ' . __($car['driver_seat_adjustment']) : null,
                    $car['passenger_seat_movement']  != null  ?  __('Front passenger seat movement adjustment') . ' : ' . __($car['passenger_seat_movement']) : null,
                    $car['heated_seats']            == 1  ?  __('heated seats') : null,
                    $car['airy_seats']              == 1  ?  __('airy seats') : null,
            ])->whereNotNull()->values()],
            [
                "name" => __('Sound and communication system'),
                "image"  => "web/img/Sound and communication system.png",
                "features" => collect([
                    $car['navigation_system']          == 1  ?  __('navigation system') : null,
                    $car['info_screen']                == 1  ?  __('info screen') : null,
                    $car['back_screen']                == 1  ?  __('Entertainment screen') : null,
                    $car['cd']                         == 1  ?  __('CDs') : null,
                    $car['bluetooth']                  == 1  ?  __('bluetooth') : null,
                    $car['mp3']                        == 1  ?  __('MP3/Additional input') : null,
                    $car['usb_audio_system']           == 1  ?  __('USB graphic interface audio system') : null,
                    $car['apple_carplay_android_auto'] == 1  ?  __('Apple CarPlay and Android Auto') : null,
                    $car['hdmi']                       == 1  ?  __('HDMI interface') : null,
                    $car['wireless_charger']           == 1  ?  __('Wireless charger for cell phone') : null,
            ])->whereNotNull()->values()],
            [
                "name" => __('Safety'),
                "image"  => "web/img/Safety.png",
                "features" => collect([
                    $car['front_airbags']              == 1  ?  __('front airbags (SRS)') : null,
                    $car['side_airbags']               == 1  ?  __('side airbags') : null,
                    $car['knee_airbags']               == 1  ?  __('Driver and front passenger knee airbags') : null,
                    $car['side_curtains']              == 1  ?  __('Side curtains') : null,
                    $car['rear_camera']                      ?  __('vision camera') . ' : ' . __(ucfirst(str_replace('_',' ',$car['rear_camera'])))  : null,
                    $car['vsa']                        == 1  ?  __('Vehicle Stability Assist (VSA)') : null,
                    $car['abs']                        == 1  ?  __('Anti-lock Braking System (ABS)') : null,
                    $car['ebd']                        == 1  ?  __('Electronic Brake-force Distribution (EBD)') : null,
                    $car['ess']                        == 1  ?  __('Emergency stop signal (ESS)') : null,
                    $car['ebb']                        == 1  ?  __('Electronic Brake-force Assist (EBB)') : null,
                    $car['tpms']                       == 1  ?  __('Tire pressure monitoring system (TPMS)') : null,
                    $car['hsa']                        == 1  ?  __('Hill Start Assist (HSA)') : null,
                    $car['ace']                        == 1  ?  __('Compatibility Engineering (ACE™) Chassis Architecture') : null,
                    $car['track_control_system']       == 1  ?  __('lane control system') : null,
                    $car['display_info_on_windshield'] == 1  ?  __('Display information on the windshield') : null,
            ])->whereNotNull()->values()],
            [
                "name" => __('Sensors'),
                "image"  => "web/img/Sensors.png",
                "features" => collect([
                    $car['acc']                  == 1  ?  __('Adaptive Cruise Control (ACC)') : null,
                    $car['rdm']                  == 1  ?  __('Road Departure Mitigation System (RDM)') : null,
                    $car['fcw']                  == 1  ?  __('Forward Collision Warning (FCW)') : null,
                    $car['blind_spots']          == 1  ?  __('Information about invisible points (blind spots)') : null,
                    $car['lsf']                  == 1  ?  __('Low Speed Relay System (LSF)') : null,
                    $car['back_traffic_alert']   == 1  ?  __('Rear traffic alert') : null,
            ])->whereNotNull()->values()]

        ]);

        return [ collect($specifications) , $features ];
    }

    public function addRemoveFromFavourite(Request $request)
    {
        if ($request['addedToFavourite'])
            removeFromFavourite( $request['carId'] );
        else
            addToFavourite( $request['carId'] );
        return response()->json(['count' => count(getFavouriteCars())]);
    }

    public function favouriteCars( Request $request )
    {
        $cars = Car::select(Car::$carCardColumns)->whereIn('id',getFavouriteCars())->paginate(9);

        return view('web.favourite_cars',compact('cars'));
    }
}
