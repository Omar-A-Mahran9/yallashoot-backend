<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\SendOtpRquest;
use App\Http\Resources\CarResourse;
use App\Models\Car;
use App\Models\CarOrder;
use App\Models\Order;
use Cache;
use Illuminate\Http\Request;
use App\Http\Traits\Calculations;
use App\Models\Bank;
use App\Models\Employee;
use App\Models\OrderNotification;
use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;

use Auth;
use Carbon\Carbon;
use DB;

class FinanceController extends Controller
{
  use Calculations;

  private $car;
  public function __construct(Car $car)
  {
    $this->car = $car; 
  }
  
  public function validationcash( Request $request){
    if($request['type']=='organization'){
      $data = $request->validate([
        'organization_name' => ['bail','required', 'string', 'max:255'],
        'organization_type' => ['bail','required', 'numeric'],
        'commercial_registration_no' => 'required|nullable|unique:cars_orders,commercial_registration_no',
        'organization_activity' => ['bail','required', 'numeric'],
        'name' => ['bail','required', 'max:255'],
        'phone' => ['bail', 'required', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
        'organization_age' => ['bail','required','numeric','min:1'],
        'city_id' => ['bail','required', 'nullable'],
        'bank_id' => ['bail','required', 'nullable', Rule::exists('banks', 'id')],
        'car_count'=> ['required','numeric','max:255'],
        ]);
        $request->merge([
          'phone' => convertArabicNumbers($request->phone),
         ]);
          $phone=$request->phone;
         $request->merge(['phone' =>  $phone]);
        //  $request->validate([
        //      'phone' => [
        //          'required',
        //           Rule::unique('orders', 'phone'),
        //      ]
        //      ]);
        $data= $this->store($request);
        $data->sendOTP();
        // OtpLink($data->phone,$data->verification_code);

       return $this->success(data:['Order_Number'=>$data->id,'verification_code'=>'-']);
      }
      elseif($request['type']=='individual'){
        $data = $request->validate([
          'name' => ['bail', 'required', 'string', 'min:10', 'max:255'],
          'phone' => ['bail', 'required', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
        ]);

        $request->merge([
          'phone' => convertArabicNumbers($request->phone),
       ]);
        // $request->validate([
        //    'phone' => [
        //        'required',
        //         Rule::unique('orders', 'phone'),
        //    ]
        //    ]);
        $data= $this->store($request);
        $data->sendOTP();
        // OtpLink($data->phone,$data->verification_code);

        return $this->success(data:['Order_Number'=>$data->id,'verification_code'=>'-']);

      }
  }

  public function validationfinance(Request $request){
    $step = $request->input('step');
    $car = $this->car->findOrFail($request->id);

    if(request('type')=='individual'){
      switch ($step) {
        case 1:
            $request->validate([
              "first_batch" => "required|numeric",
              "last_batch" => "required|numeric",
              "installment" => "required|numeric"
                      ]);
                      $carResource = CarResourse::make($car)->resolve();

                      return [
                        "brand" => $carResource['brand']['title'],
                        "model" => $carResource['model']['title'],
                        "category" => $carResource['categories']['title']??null,
                        "year" => $carResource['year'],
                        "gear_shifter"=>$carResource['gear_shifter'],
                        "color_id"=>$carResource['color']['title'],
                        ];
              break;          
        case 2:
         
            break;
        case 3:
            $request->validate([
            "client_name" => "required",
            'email' => ['bail', 'required', 'email:rfc,dns', 'max:255'],
            'phone' => ['bail', 'required', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            "sex" => "required",
            'birth_date' => 'required|date|before_or_equal:' . Carbon::now()->subYears(16)->toDateString(),
            "city_id"=>"required|numeric",
            "identity_no" => ["required", "numeric", "digits:10"], // Validation rule for exactly 8 digits
            'sector'=>"required|numeric",
            'salary'=>"required|numeric",
            'bank'=>'required|numeric',
            'Monthly_cometment'=>'required|numeric',
            'driving_license' =>  ['required', 'boolean'],
            'traffic_violations' =>  ['required', 'boolean'],
            'have_life_problem' => ['required', 'boolean'],
            'department_loan' => ['required', 'boolean'],
            'nationality_id'=>'required|numeric',

          ]);
          $request->merge(['phone' => $request->phone]);
          $request->validate([
              'phone' => [
                  'required',
                   Rule::unique('orders', 'phone'),
              ]
              ]);
          if($request->have_life_problem==true || $request->Monthly_cometment<600){
            $data= [];
          }else{
            $request['car']=$car;
            $data=$this->calculateInstallmentscar($request);
          }
          return $this->success(data: $data);
          break;
  
        case 4:
            $request->validate([
              "bank_offer_id" => 'required|numeric',
              'identity_Card' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', 
              'License_Card' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', 
              'Hr_Letter_Image' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', 
              'Insurance_Image' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
            ]);
            $request['car']=$car;
            $data = $this->calculateInstallmentscar($request);
            $view_selected_Offer = null;
           foreach ($data as $selectedOffer) {
               if ($selectedOffer['bank_offer_id'] == $request['bank_offer_id']) { 
                   $view_selected_Offer = $selectedOffer;
                   break; // Exit the loop once a matching offer is found
               }
           }
           return $this->success(data: $view_selected_Offer ??[]);

          break;
  
          case 5:
            $carResource = CarResourse::make($car)->resolve();

            //  DB::beginTransaction();
            // try {
            $car = Car::where('model_id', request('model'))
                  ->where('brand_id', request('brand'))
                  ->where('year', request('year'))
                  ->where('gear_shifter',request('gear_shifter'))
                  ->first()??$car;
                  $request['car']=$car;
                  $data=$this->calculateInstallmentscar($request);
                  foreach($data as $selectedOffer){
                    if ($selectedOffer['bank_offer_id']==$request['bank_offer_id']){
                      $view_selected_Offer=$selectedOffer;
                    }
                  }
            $ordersTableData=[
            // Orders Table Data
            'first_installment' =>$request->first_batch,
            'last_installment' => $request->last_batch,
            'installment'=>$view_selected_Offer['years'],
              'car_id' => $car->id,
              'name' => $request->client_name,
              'phone' => convertArabicNumbers($request->phone),
              'sex'=>$request->sex,
              'price'=>$car->getPriceAfterVatAttribute(),
              'car_name'=>$car->name,
              'city_id'=>$request->city_id,
            // CarOrder Table Data
              'payment_type' => 'finance',
              'salary'=>$request->salary,
              'commitments'=>$request->Monthly_cometment,
              'having_loan'=>$request->department_loan,
              'driving_license'=>$request->driving_license,
              'birth_date'=>$request->birth_date,
              'bank_id'=>$request->bank,
              'sector_id'=>$request->sector,
              'bank_offer_id'=>$view_selected_Offer['bank_offer_id'],
              'transfer'=>$request->transferd_type,
              'nationality_id'=>$request->nationality_id,
              
            ];
  
            $ordersTableData['type'] = 'car';
             $ordersTableData['car_name'] = $car->name;
            $ordersTableData['phone'] = convertArabicNumbers($ordersTableData['phone']);
   
            $ordersTableData['payment_type'] = 'finance';
            $ordersTableData['client_id'] =  Auth::user()->id??null;;
            $ordersTableData['status_id'] = 1;

            if ($request->file('identity_Card'))
            $ordersTableData['identity_Card'] = uploadImage( $request->file('identity_Card') , "Orders");
  
            if ($request->file('License_Card'))
            $ordersTableData['License_Card'] = uploadImage( $request->file('License_Card') , "Orders");
            
            if ($request->file('Hr_Letter_Image'))
            $ordersTableData['Hr_Letter_Image'] = uploadImage( $request->file('Hr_Letter_Image') , "Orders");
  
            if ($request->file('Insurance_Image'))
            $ordersTableData['Insurance_Image'] = uploadImage( $request->file('Insurance_Image') , "Orders");
  
            $ordersTableData['car_id']=$car->id;
            $ordersTableData['client_id']=$car['vendor']['id'];
            $ordersTableData['last_payment_value'] = $view_selected_Offer['last_installment'];
            $ordersTableData['finance_amount'] = $view_selected_Offer['fundingAmount'];
            $ordersTableData['Adminstrative_fees'] = $view_selected_Offer['sectorAdministrative_fees'];
            $order = Order::create($ordersTableData);
                      $this->distribute($order->id);

            $order->sendOTP();

            $ordersTableData['order_id'] = $order->id;
            $ordersTableData['type']=$request->type;
           
            $ordersTableData['first_payment_value'] = $view_selected_Offer['firs_installment'];
            $ordersTableData['last_payment_value'] = $view_selected_Offer['last_installment'];
            $ordersTableData['finance_amount'] = $view_selected_Offer['fundingAmount'];
            $ordersTableData['Adminstrative_fees'] = $view_selected_Offer['sectorAdministrative_fees'];
            $ordersTableData['Monthly_installment'] = $view_selected_Offer['monthly_installment'];

            
            CarOrder::create($ordersTableData);
            $notify=[
              'vendor_id'=>Auth::id()??null,
              'order_id'=>$order->id,
              'is_read'=>false,
              'phone'=>auth()->user()->phone??$order->phone,
              'type'=>'order',
             ];
            OrderNotification::create($notify);
            // OtpLink( $order->phone,$order->verification_code);

            return $this->success(data:['Order_Number'=>$order->id,'verification_code'=>'-']);

            // DB::commit();
            //  $this->sendEmailToAdmin($order);
            } 
          //   catch (\Throwable $th) {
          //     DB::rollBack();
          //     return response()->json([['error' => "something went wrong"], 500]);
          // }
    }
  
      if(request('type')=='organization'){
         // $uniqueCars = [];
        switch ($step) {
    
          case 1:
        $carOrdersTableData = $request->validate([
            'organization_name' => ['bail','required', 'string', 'max:255'],
            'organization_type' => ['bail','required', 'numeric' ],
            'commercial_registration_no' => ['required', 'nullable', 'numeric'],
            'organization_activity' => ['bail','required', 'numeric'],
            'name' => ['bail','required', 'max:255'],
            'phone' => ['bail', 'required', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'organization_age' => ['bail','required', 'min:1'],
            'city_id' => ['bail','required', 'nullable'],
            'bank_id' => ['bail','required', 'nullable', Rule::exists('banks', 'id')],
            'car_count'=> ['required','numeric','max:255'],

            ]);
         $ordersTableData['type'] = 'car';
        $ordersTableData['phone'] = convertArabicNumbers($carOrdersTableData['phone']);
        $request->merge(['phone' =>   $ordersTableData['phone']]);
        // $request->validate([
        //     'phone' => [
        //         'required',
        //          Rule::unique('orders', 'phone'),
        //     ]
        //     ]);
        $ordersTableData['name'] = $carOrdersTableData['name'];
        $ordersTableData['status_id']=1;
        $ordersTableData['car_id']=$car->id;
        $ordersTableData['price']=$car->getPriceAfterVatAttribute()*$carOrdersTableData['car_count'];
        $ordersTableData['city_id']=$carOrdersTableData['city_id'];;
        $ordersTableData['car_name']=$car->name;

        $ordersTableData['clint_id']=Auth::user()->id??null;

        DB::beginTransaction();
        try {
           $order =  Order::create($ordersTableData);
           $this->distribute($order->id);
 
          $order->sendOTP();
          
           $carOrdersTableData['type'] = 'organization';
            $carOrdersTableData['payment_type'] = 'finance';
            $carOrdersTableData['order_id'] = $order->id;
            $carOrdersTableData['car_count'] =$carOrdersTableData['car_count'] ;
            // $carOrdersTableData['cars'] = json_encode($uniqueCars);
            $CarOrder=  CarOrder::create($carOrdersTableData);
            $notify=[
              'vendor_id'=>Auth::id()??null,
              'order_id'=>$order->id,
              'is_read'=>false,
              'phone'=>auth()->user()->phone??$order->phone,
              'type'=>'order',

            ];
            OrderNotification::create($notify);
            DB::commit();
            // $this->sendEmailToAdmin($order);
 
            // OtpLink( $order->phone,$order->verification_code);

            return $this->success(data:['Order_Number'=>$order->id,'verification_code'=>'-']);

  
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            DB::rollBack();
            return response()->json(['error' => "something went wrong"], 500);
        }
  
      }
      
  }
   
  }

  public function store($request){
     $car = $this->car->findOrFail($request->id);
     if($request->type=='organization'){
        $totalcarprice=$car->getPriceAfterVatAttribute()*$request->car_count;
 
        $data=[
          'organization_name' => $request->organization_name,
          'organization_type' => $request->organization_type,
          'commercial_registration_no' =>$request->commercial_registration_no,
          'organization_activity' =>  $request->organization_activity,
          'name' => $request->name,
          'phone' => $request->phone,
          'organization_age' => $request->organization_age,
          'city_id' => $request->city_id,
          'bank_id' => $request->bank_id,
          'price' => $totalcarprice,
          'car_name' => $car->getNameAttribute(),
          'car_id' => $car->id,
          'type' => 'car',   
          'status_id' => 1,
          'client_id' => $car->vendor_id,
          'car_count'=> $request->car_count,
 
        ];
        $order=Order::create($data);
        $this->distribute($order->id);
        $data['type']=$request['type'];
        $data['order_id']=$order->id;
        $carorder=CarOrder::create($data);
        $notify=[
          'vendor_id'=>Auth::id()??null,
          'order_id'=>$order->id,
          'is_read'=>false,
          'phone'=>auth()->user()->phone??$request->phone,
          'type'=>'order',

        ];
        OrderNotification::create($notify);
        return  $order;
     }
     elseif($request->type=='individual'){
         $data=[
            'name' => $request->name,
            'phone' => $request->phone,
            'price' => $car->getPriceAfterVatAttribute(),
            'car_name' => $car->getNameAttribute(),
            'car_id' => $car->id,
            'type' => 'car',   
            'status_id' => 1,
            'client_id' => $car->vendor_id,
            'city_id' => $car->city_id,

          ];
          
          $order=Order::create($data);
          $this->distribute($order->id);
          $data=[
            'order_id'=>$order->id,
            'type'=>$request['type'],
          ];
            $carorder=CarOrder::create($data);
            $notify=[
              'vendor_id'=>Auth::id()??null,
              'order_id'=>$order->id,
              'is_read'=>false,
              'phone'=>auth()->user()->phone??$request->phone,
              'type'=>'order',
            ];
            OrderNotification::create($notify);
            return  $order;
     }
  }

//FinanceRequest

public function financeOrder(Request $request){
   // if(auth()->check()){
  //   dd( 'omaar');
  // }
  // else{
  //   dd( 'notlogin');

  // }
 
   $step = $request->input('step');
  if(request('type')=='individual'){
     switch ($step) {
      case 1:
          $request->validate([
            "first_batch" => "required|numeric",
            "last_batch" => "required|numeric",
            "installment" => "required|numeric"
                    ]);
           break;              
      case 2:
          $request->validate([
            "brand" => "required|numeric",
            "model" => "required|numeric",
            "category" => "required|numeric",
            "year" => "required|numeric",
            "gear_shifter"=>"required",
            "color_id"=>"required|numeric"
          ]);
          break;
      case 3:
          $request->validate([
          "client_name" =>['required' , 'string',new NotNumbersOnly],
          'email' => ['bail', 'required', 'email:rfc,dns', 'max:255'],
          'phone' => ['bail', 'required', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
          "sex" => "required",
          'birth_date' => 'required|date|before_or_equal:' . Carbon::now()->subYears(16)->toDateString(),
          "city_id"=>"required|numeric",
          'identity_no' => 'required|nullable|unique:orders,identity_no|numeric|digits:10',
          'sector'=>"required|numeric",
          'salary'=>"required|numeric",
          'bank'=>'required|numeric',
          'Monthly_cometment'=>'required|numeric',
          'driving_license' =>  ['required', 'boolean'],
          'traffic_violations' =>  ['required', 'boolean'],
          'have_life_problem' => ['required', 'boolean'],
          'department_loan' => ['required', 'boolean'],
          'nationality_id'=>'required|numeric',
        ]);
        $ordersTableData['phone'] = convertArabicNumbers($request->phone);
        $request->merge(['phone' =>   $ordersTableData['phone']]);
        $request->validate([
            'phone' => [
                'required',
                 Rule::unique('orders', 'phone'),
            ]
            ]);
        if($request->have_life_problem==true || $request->Monthly_cometment<600){
          $data= [];

        }else{
          
          $data=$this->calculateInstallmentscar($request);
        }
         return $this->success(data: $data);
        break;

      case 4:
          $request->validate([
            'bank_offer_id' => 'required|exists:bank_offers,id',
            'identity_Card' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', 
            'License_Card' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', 
            'Hr_Letter_Image' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', 
            'Insurance_Image' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
          ]);

           $data = $this->calculateInstallmentscar($request);
           $view_selected_Offer = null;

          foreach ($data as $selectedOffer) {
              if ($selectedOffer['bank_offer_id'] == $request['bank_offer_id']) { 
                  $view_selected_Offer = $selectedOffer;
                  break; // Exit the loop once a matching offer is found
              }
          }
            return $this->success(data: $view_selected_Offer ??[]);
    case 5:
          $car = Car::where('model_id', request('model'))
                ->where('brand_id', request('brand'))
                ->where('year', request('year'))
                ->where('gear_shifter',request('gear_shifter'))
                ->first();
                $data=$this->calculateInstallmentscar($request);
                foreach($data as $selectedOffer){
                  if ($selectedOffer['bank_offer_id']==$request['bank_offer_id']){
                    $view_selected_Offer=$selectedOffer;
                  }
                }
           $ordersTableData=[
          // Orders Table Data
            'first_installment' =>$request->first_batch,
            'last_installment' => $request->last_batch,
            'installment'=>$view_selected_Offer['years'],
            'car_id' => $car->id,
            'name' => $request->client_name,
            'phone' => convertArabicNumbers($request->phone),
            'nationality_id'=>$request->nationality_id,
            'identity_no'=>$request->identity_no,
            'sex'=>$request->sex,
            'price'=>$car->getPriceAfterVatAttribute(),
            'car_name'=>$car->name,
            'city_id'=>$request->city_id,
          // CarOrder Table Data
            'payment_type' => 'finance',
            'salary'=>$request->salary,
            'commitments'=>$request->Monthly_cometment,
            'having_loan'=>$request->department_loan,
            'driving_license'=>$request->driving_license,
            'birth_date'=>$request->birth_date,
            'bank_id'=>$request->bank,
            'sector_id'=>$request->sector,
            'bank_offer_id'=>$view_selected_Offer['bank_offer_id'],
            'transfer'=>$request->transferd_type
          ];
          $ordersTableData['type'] = 'car';
          $ordersTableData['car_name'] = $car->name;
          $ordersTableData['phone'] = convertArabicNumbers($ordersTableData['phone']);
          
          $ordersTableData['payment_type'] = 'finance';
          $ordersTableData['client_id'] =  Auth::user()->id??null;;
          $ordersTableData['status_id'] = 1;
 
          if ($request->file('identity_Card'))
          $ordersTableData['identity_Card'] = uploadImage( $request->file('identity_Card') , "Orders");

          if ($request->file('License_Card'))
          $ordersTableData['License_Card'] = uploadImage( $request->file('License_Card') , "Orders");
          
          if ($request->file('Hr_Letter_Image'))
          $ordersTableData['Hr_Letter_Image'] = uploadImage( $request->file('Hr_Letter_Image') , "Orders");

          if ($request->file('Insurance_Image'))
          $ordersTableData['Insurance_Image'] = uploadImage( $request->file('Insurance_Image') , "Orders");

          $order = Order::create($ordersTableData);
          $this->distribute($order->id);

          $order->sendOTP();

          $ordersTableData['first_payment_value'] = $view_selected_Offer['firs_installment'];
          $ordersTableData['last_payment_value'] = $view_selected_Offer['last_installment'];
          $ordersTableData['finance_amount'] = $view_selected_Offer['fundingAmount'];
          $ordersTableData['Adminstrative_fees'] = $view_selected_Offer['sectorAdministrative_fees'];
          $ordersTableData['Monthly_installment'] = $view_selected_Offer['monthly_installment'];

          $ordersTableData['order_id'] = $order->id;
          $ordersTableData['type']=$request->type;
          CarOrder::create($ordersTableData);
          $notify=[
            'vendor_id'=>Auth::id()??null,
            'order_id'=>$order->id,
            'is_read'=>false,
            'phone'=>auth()->user()->phone??$ordersTableData['phone'],
            'type'=>'order',

          ];
          OrderNotification::create($notify);
          // OtpLink( $order->phone,$order->verification_code);

          return $this->success(data:['Order_Number'=>$order->id,'verification_code'=>'-']);

           //  $this->sendEmailToAdmin($order);
          } 
 
  }

    if(request('type')=='organization'){

      switch ($step) {
        case 1:
        $request->validate([
          'cars' => ['bail','required', 'array'],
        ]);
        try {
          $cars=$this->getCars($request->input('cars'));
          return  $cars;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
     
     break;
        case 2:
       $carOrdersTableData = $request->validate([
          'cars' => ['bail','required', 'array'],
          'organization_name' => ['bail','required', 'string', 'max:255',new NotNumbersOnly],
          'organization_type' => ['bail','required', 'numeric'],
          'commercial_registration_no' => ['required','nullable', 'numeric'],
          'organization_activity' => ['bail','required', 'numeric'],
          'name' => ['required' , 'string',new NotNumbersOnly],
          'phone' => ['bail', 'required','regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
          'organization_age' => ['bail','required', 'min:1'],
          'city_id' => ['bail','required', 'nullable'],
          'bank_id' => ['bail','required', 'nullable', Rule::exists('banks', 'id')],
          ]);
          $ordersTableData['price']=0;

          $cars=$this->getCars($request->input('cars'));
          foreach ($cars as &$item) {
            $ordersTableData['price'] += $item['price'] * $item['count'];
        }

      $ordersTableData['type'] = 'car';
      $ordersTableData['phone'] = convertArabicNumbers($carOrdersTableData['phone']);
      $request->merge(['phone' =>   $ordersTableData['phone']]);
      // $request->validate([
      //     'phone' => [
      //         'required',
      //          Rule::unique('orders', 'phone'),
      //     ]
      //     ]);
      $ordersTableData['name'] = $carOrdersTableData['name'];
      $ordersTableData['status_id']=1;
      $ordersTableData['city_id']=$carOrdersTableData['city_id'];
      $ordersTableData['bank_id']=$carOrdersTableData['bank_id'];;
      $ordersTableData['clint_id']=Auth::user()->id??null;
      DB::beginTransaction();
      try {
          $order =  Order::create($ordersTableData);
          $this->distribute($order->id);
          $order->sendOTP();
           $carOrdersTableData['type'] = 'organization';
          $carOrdersTableData['payment_type'] = 'finance';
          $carOrdersTableData['order_id'] = $order->id;
          $carOrdersTableData['cars'] = json_encode($cars);
        $CarOrder=  CarOrder::create($carOrdersTableData);
        $notify=[
          'vendor_id'=>Auth::id()??null,
          'order_id'=>$order->id,
          'is_read'=>false,
          'phone'=>auth()->user()->phone??$ordersTableData['phone'],
          'type'=>'order',
        ];
        OrderNotification::create($notify);
          DB::commit();
          // $this->sendEmailToAdmin($order);


      } catch (\Throwable $th) {
          // dd($th->getMessage());
          DB::rollBack();
          return response()->json(['error' => "something went wrong"], 500);
      }
      // OtpLink( $order->phone,$order->verification_code);

      return $this->success(data:['Order_Number'=>$order->id,'verification_code'=>'-']);

    }
    
}
 
}
 

public function getCars($request){
  $uniqueCars = [];
  $jsonString = $request;
  $arrayOfObjects = $jsonString;
   foreach ($arrayOfObjects as $key=> $object) {
      $brand = $object['brand'];
      $model = $object['model'];
      $year = $object['year'];
      $color = $object['color'];
      $gear_shifter = $object['gear_shifter'];
      $car_count = $object['car_count'];
      $carIdentifier = Car::where('brand_id', $brand)
      ->where('model_id', $model)
      ->where('year', $year)
      ->where('color_id', $color)
      ->where('gear_shifter', $gear_shifter)
      ->first();
    if ($carIdentifier) {
    $existingCar = collect($uniqueCars)->firstWhere('car_id', $carIdentifier->id);
    if ($existingCar) {
       return $this->validationFailure(errors: ['errors' => __('car exist before'), 'field_number' => $key]);
 
    }
     $uniqueCars[] = [ 'car_id'=>$carIdentifier->id, 'car_name'=>$carIdentifier->name_en, 'count'=>$car_count,'price'=>$carIdentifier->getPriceAfterVatAttribute()];
   }
  else{
    return $this->validationFailure(errors: ['errors'=>__('This car not found'),'field_number' => $key]);

    // $uniqueCars[] = ['error' => __('This car not found'), 'field_number' => $key];
  }
  }
  return $uniqueCars;
}
 

   public function calculate(Request $request)
  {
      return $this->calculateByAmount($request);
  }


public function verifyOtp(Request $request){
    $phone=convertArabicNumbers($request->phone);
    $order = Order::where('id',$request->order_id)->where('phone',$phone)->first();
    if($order){
      $result = $order->verifyOTP($request->otp);
      return $result ? $this->success(data:['Order_Number'=>$order->id,'verification_code'=>'-']) : $this->validationFailure(errors: __('wrong code'));
    }
    else{
       return $this->failure(message:'Sorry this Order Not Found to verify plaese Check phone number or order number');
    }


}



public function distribute($order_id)
    {
        // Your distribution logic here
        // Example: Distribute orders evenly among employees

        $employees = Employee::whereHas('roles.abilities', function ($query) {
            $query->where('name', 'received_order_received');
        })->get();

        $orders = Order::get();

        $employeeCount = $employees->count();
        $orderCount = $orders->count();

        if ($employeeCount > 0 && $orderCount > 0) {
           $ordersmustPerEmployee = ceil($orderCount / $employeeCount);
           
           
           foreach ($employees as $employee) {
            $ordersnumberforemployee=Order::where('employee_id',$employee->id)->count();
            if( $ordersnumberforemployee<$ordersmustPerEmployee){
              Order::find($order_id)->update(['employee_id' => $employee->id]);
            }
           }
 
         
      } else {
          
      }
   
    }


    public function resendOtp(SendOtpRquest $request)
    {
        $phone=convertArabicNumbers($request->phone);
        $order = Order::where('phone', $phone)->where('id',$request->orderId)->first();
        $order->sendOTP();
        return $this->success(data: ['phone' =>$phone]);
    }

}