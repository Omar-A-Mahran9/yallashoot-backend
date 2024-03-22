<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResourse;
use App\Http\Traits\Calculations;
use App\Models\BankOffer;
use App\Models\Car;
use App\Models\Employee;
use App\Models\Order;
use App\Models\SettingOrderStatus;
use Auth;
use DB;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    use Calculations;

    public function index(){
      try
        {
            $type=request()->type;
            $allOrders=[];

      if (auth()->check()) { 
 
                if(Auth::user()){

                     if(request('filter')=='complete'){
                        $orders = Order::where('phone', Auth::user()->phone)->where('verified',1)->where('status_id',6)->with('car','orderDetailsCar')->whereNull('deleted_at')->get();
                      }
                      elseif(request('filter')=='processing'){
                        $orders = Order::where('phone', Auth::user()->phone)->where('verified',1)->whereIn('status_id', [1, 2, 3, 4, 5])
                        ->with('car','orderDetailsCar')->whereNull('deleted_at')->get();

                      }else{
                        $orders = Order::where('phone', Auth::user()->phone)->where('verified',1)->with('car','orderDetailsCar')->whereNull('deleted_at')->get();
                      }      
                      foreach ($orders as $order) {
                         $orderDetails=$order->orderDetailsCar;
                         if ($orderDetails->type == 'organization'&& $orderDetails->cars !== null) {
                            $cars=$order['orderDetailsCar']['cars'];
                               $carsArray = json_decode($cars);
                               $cars_in_orders=[];
             
                               foreach($carsArray as $car){
                                  $carconvert=Car::find($car->car_id);
                                  $carDetails=CarResourse::make($carconvert)->resolve();
                                  $carData=[
                                     "car_id"=>$carDetails['id'],
                                     'car_title'=>$carDetails['main_title'],
                                     "carimage"=>$carDetails['main_image'],
                                     'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                                     'carcount'=>$car->count
                                           ];
                                  $cars_in_orders[]=$carData;
                                            }   
                                  $allOrders[]=['cars'=>$cars_in_orders,'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),'OrderPaymentType'=>$orderDetails->payment_type,'OrderType'=>$orderDetails->type];

                                }
                         elseif($orderDetails->type == 'organization'&& $orderDetails->cars == null &&$order->car_id!=null){
                                $cars_in_orders=[];
                                $car=Car::find($order->car_id);
                                $carDetails=CarResourse::make($car)->resolve();
                                $carData=[
                                    "car_id"=>$carDetails['id'],
                                    'car_title'=>$carDetails['main_title'],
                                    "carimage"=>$carDetails['main_image'],
                                    'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                                    'carcount'=>$orderDetails->car_count
                                        ];
                                        $cars_in_orders[]=$carData;
                                $allOrders[] =['cars'=>$cars_in_orders,'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),'OrderPaymentType'=>$orderDetails->payment_type,'OrderType'=>$orderDetails->type];
                         }
                         elseif($orderDetails->type == 'individual'&& $orderDetails->cars == null &&$order->car_id!=null){
                            $carDetails=CarResourse::make($order->car)->resolve();

                            if($orderDetails->payment_type == 'finance'){
                            $bankOffer=BankOffer::with('sectors')->find($order['orderDetailsCar']['bank_offer_id']);
                          
                            $fundingAmount = $order['orderDetailsCar']['finance_amount'];;
                            $installment_years=$order['orderDetailsCar']['installment'];
                            $last_installment=$order['orderDetailsCar']['last_payment_value'];
                            $first_installment=$order['orderDetailsCar']['last_payment_value'];
                            $monthlyInstallment=$order['orderDetailsCar']['Monthly_installment'];
                            $adminstrativefees=$order['orderDetailsCar']['Adminstrative_fees'];
            
          
                     

 
             
                            $order=[
                                'order_id'=>$order['id'],
                                'car_title'=>$carDetails['main_title'],
                                'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                                'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),
                                'offer_name'=>$bankOffer->title,
                                'funding_amount'=>$fundingAmount,
                                'adminstrative_fields'=>$adminstrativefees,
                                'order_Date' => optional($order['orderDetailsCar']['created_at'])->format('Y-m-d'),
                                'first_installment'=>$first_installment,
                                'last_installment'=>$last_installment,
                                'monthly_installment'=>$monthlyInstallment,
                                'installment'=>$installment_years,
                                'car_id'=>$carDetails['id'],
                                'OrderPaymentType'=>$orderDetails->payment_type,
                                'OrderType'=>$orderDetails->type
                            ];

                            }
                            else{
                                $order=[
                                    'order_id'=>$order['id'],
                                    'car_title'=>$carDetails['main_title'],
                                    'cash_order'=>$carDetails['price_after_tax'],
                                    'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                                     'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),
                                    'order_Date' => optional($order['orderDetailsCar']['created_at'])->format('Y-m-d'),
                                    'car_id'=>$carDetails['id'],
                                    'OrderPaymentType'=>$orderDetails->payment_type,
                                    'OrderType'=>$orderDetails->type
                                ];
                            }

                            
                            $allOrders[] =$order;

                    }
                        }
                        }
    
                   return $this->success(data:$allOrders);    
 
                }  
            else{
                $order_number=request('order_number');
                $allOrders=$this->search($order_number);
            }
         

        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }



    public function search(Request $request){    
 
         $ordernumber=$request->order_number;
          $order=Order::where('id',$ordernumber)->whereNull('deleted_at')->with('orderDetailsCar')->first();
           if($order){
             if($order->orderDetailsCar->type=='organization' && $order->orderDetailsCar->cars != null){
                $cars=$order['orderDetailsCar']['cars'];
                $carsArray = json_decode($cars);
                $cars_in_orders=[];
                foreach($carsArray as $car){
                    $carconvert=Car::find($car->car_id);
                    $carDetails=CarResourse::make($carconvert)->resolve();
                    $carData=[
                    "order_id"=>$order->id,
                    "car_id"=>$carDetails['id'],
                    'car_title'=>$carDetails['main_title'],
                    "carimage"=>$carDetails['main_image'],
                    'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                    'carcount'=>$car->count,
                    'OrderPaymentType'=>$order['orderDetailsCar']['payment_type'],
                    'OrderType'=>$order['orderDetailsCar']['type'],
                    ];
                    $cars_in_orders[]=$carData;
                }   
                $allOrders =['cars'=>$cars_in_orders,'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),'OrderPaymentType'=>$order->orderDetailsCar['payment_type'],'OrderType'=>$$order->orderDetailsCar['type']];
            }
          elseif($order->orderDetailsCar->type=='organization' &&$order->car_id!=null){
                $car=Car::find($order->car_id);
                    $carDetails=CarResourse::make($car)->resolve();
                    $carData=[
                    "order_id"=>$order->id,
                    "car_id"=>$carDetails['id'],
                    'car_title'=>$carDetails['main_title'],
                    "carimage"=>$carDetails['main_image'],
                    'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                    'carcount'=>$order->orderDetailsCar->car_count,
                    'OrderPaymentType'=>$order['orderDetailsCar']['payment_type'],
                    'OrderType'=>$order['orderDetailsCar']['type'],
                    ];
                    $cars_in_orders[]=$carData;
                    $allOrders=['cars'=>$cars_in_orders,'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),'OrderPaymentType'=>$order->orderDetailsCar['payment_type'],'OrderType'=>$order->orderDetailsCar['type']];
                }


              $orderDetails=$order->orderDetailsCar;
              $carDetails=CarResourse::make($order->car)->resolve();
         if($order->orderDetailsCar->type=='individual' ){

                    $orderDetails=$order->orderDetailsCar;
                    $carDetails=CarResourse::make($order->car)->resolve();
                    if($orderDetails->payment_type == 'finance'){
                        $bankOffer=BankOffer::with('sectors')->find($order['orderDetailsCar']['bank_offer_id']);
                         $fundingAmount = $order['orderDetailsCar']['finance_amount'];;
                        $installment_years=$order['orderDetailsCar']['installment'];
                        $last_installment=$order['orderDetailsCar']['last_payment_value'];
                        $first_installment=$order['orderDetailsCar']['first_payment_value'];
                        $monthlyInstallment=$order['orderDetailsCar']['Monthly_installment'];
                        $adminstrativefees=$order['orderDetailsCar']['Adminstrative_fees'];
        
                            //  $this->calculateInstallmentscarOrders($order);
                            $order=[
                                'order_id'=>$order['id'],
                                'car_title'=>$carDetails['main_title'],
                                'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                                'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),
                                'offer_name'=>$bankOffer->title,
                                'funding_amount'=>$fundingAmount,
                                'adminstrative_fields'=>$adminstrativefees,
                                'order_Date' => optional($order['orderDetailsCar']['created_at'])->format('Y-m-d'),
                                'first_installment'=>$first_installment,
                                'last_installment'=>$last_installment,
                                'monthly_installment'=>$monthlyInstallment,
                                'installment'=>$installment_years,
                                'car_id'=>$carDetails['id'],
                                'OrderPaymentType'=>$orderDetails->payment_type,
                                'OrderType'=>$orderDetails->type
                            ];
                    }
             else{
                         $order=[
                            'order_id'=>$order['id'],
                            'car_title'=>$carDetails['main_title'],
                            'cash_order'=>$carDetails['price_after_tax'],
                            'options' => $carDetails['color']['title'] . " - " . $carDetails['gear_shifter'] . " - " . $carDetails['year'],
                             'orderStatue' => SettingOrderStatus::find($order->status_id)->only(['name', 'color']),
                            'order_Date' => optional($order['orderDetailsCar']['created_at'])->format('Y-m-d'),
                            'car_id'=>$carDetails['id'],
                            'OrderPaymentType'=>$orderDetails->payment_type,
                            'OrderType'=>$orderDetails->type
                        ];
                  }
              $allOrders=$order??[] ;

            
                    }

                     return $this->success(data:[$allOrders]);

    }

  
else{
    return $this->success(data:[]);
}
}

public function employeeapi(){
    $empolyees=Employee::select('id','name')->get();
    return $empolyees;
}
}