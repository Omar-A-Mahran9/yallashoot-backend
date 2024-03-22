<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\City;
use App\Models\Bank;
use App\Http\Controllers\Controller;
use App\Models\CarOrder;
use App\Models\Order;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrder;

class OrderController extends Controller
{
    public function create()
    {
        $type = request('type') ?? 'individuals';

        $cars   = Car::select('id', 'name_'.getLocale(), 'discount_price', 'price', 'have_discount', 'price_field_status', 'price_field_value','tax')->get();
        $cities = City::select('id', 'name_'.getLocale())->get();
        $banks  = Bank::select('id', 'name_'.getLocale())->get();

        return view('web.purchase-car', compact('cars', 'cities', 'banks', 'type'));

    }


    public function individualsFinance(Request $request){
        $car = Car::select('id', 'have_discount', 'discount_price', 'price','name_'.getLocale(),'tax')->where('id', $request->car_id)->first();

        if(!$car)
        {
            throw ValidationException::withMessages([
                'car_id' => __("You must select a car")
            ]);
        }

        $ordersTableData = $request->validate([
            // Orders Table Data
            'name' => ['bail', 'required', 'max:255'],
            'phone' => ['bail', 'required', 'numeric'],
            // 'price' => ['bail', 'required', 'numeric', 'min:20000', 'in:'.$car->price_after_vat],
            // 'car_name' => ['bail', 'required', Rule::exists('cars', 'name_'.getLocale())],
            'car_id' => ['bail', 'required'],
            'city_id' => ['bail', 'required', 'exists:App\Models\City,id'],


             // CarOrder Table Data
            'salary' => ['bail','numeric', 'required', 'min:3000'],
            'commitments' => ['bail','required', 'min:1'],
            'having_loan' => ['bail','required', 'in:1,0'],
            'first_installment' => ['bail','required', 'in:0,10,15,20,25'],
            'last_installment' => ['bail','required', 'in:25,30,35,40,45,50'],
            'driving_license' => ['bail','required', 'in:available,expired,doesnt_exist'],
            'work' => ['bail','required', 'string', 'max:255'],
            'bank_id' => ['bail','required', 'nullable', Rule::exists('banks', 'id')],
        ]);

        $ordersTableData['type'] = 'car';
        $ordersTableData['price'] = $car->price_after_vat;
        $ordersTableData['car_name'] = $car->name;
        $ordersTableData['phone'] = convertArabicNumbers($ordersTableData['phone']);

        $ordersTableData['payment_type'] = 'finance';

        DB::beginTransaction();
        try {

            $order =  Order::create($ordersTableData);

            $ordersTableData['first_payment_value'] = round($order['price'] * ($ordersTableData['first_installment'] / 100), 0);
            $ordersTableData['order_id'] = $order->id;
            $ordersTableData['type'] = 'individual';

            CarOrder::create($ordersTableData);
            DB::commit();
            $this->sendEmailToAdmin($order);


        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([['error' => "something went wrong"], 500]);
        }
    }

    public function individualsCash(Request $request){

        $car = Car::select('id', 'have_discount', 'discount_price', 'price','name_'.getLocale(),'tax')->where('id', $request->car_id)->first();

        if(!$car)
        {
            throw ValidationException::withMessages([
                'car_id' => __("You must select a car")
            ]);
        }

        $ordersTableData = $request->validate([
            'name' => ['bail', 'required', 'max:255'],
            'phone' => ['bail', 'required', 'numeric' ],
            // 'price' => ['bail', 'required', 'numeric', 'min:20000', 'in:'.$car->price_after_vat],
            // 'car_name' => ['bail', 'required', Rule::exists('cars', 'name_'.getLocale())],
            'car_id' => ['bail', 'required'],
        ]);
        $ordersTableData['type'] = 'car';
        $ordersTableData['price'] = $car->price_after_vat;
        $ordersTableData['car_name'] = $car->name;
        $ordersTableData['phone'] = convertArabicNumbers($ordersTableData['phone']);

        DB::beginTransaction();
        try {

            $order =  Order::create($ordersTableData);

            $carOrdersTableData['type'] = 'individual';
            $carOrdersTableData['payment_type'] = 'cash';
            $carOrdersTableData['order_id'] = $order->id;

            CarOrder::create($carOrdersTableData);
            DB::commit();
            $this->sendEmailToAdmin($order);


        } catch (\Throwable $th) {
            DB::rollBack();
            // return response()->json(['error' => "something went wrong"], 500);
            throw $th;
        }
    }

    public function corporateFinance(Request $request){
        $carOrdersTableData = $request->validate([
            'cars.*.car_name' => ['bail','required', 'string'],
            'cars.*.count' => ['bail','required', 'integer'],
            'organization_name' => ['bail','required', 'string', 'max:255'],
            'organization_email' => ['bail','required', 'max:255', "email:rfc,dns"],
            'organization_ceo' => ['bail','required', 'max:255'],
            'phone' => ['bail','required', 'numeric'],
            'organization_location' => ['bail','required', 'max:255'],
            'organization_activity' => ['bail','required', 'max:255'],
            'organization_age' => ['bail','required', 'min:1'],
            'bank_id' => ['bail','required', 'nullable', Rule::exists('banks', 'id')],
        ]);

        $ordersTableData['type'] = 'car';
        $ordersTableData['phone'] = convertArabicNumbers($carOrdersTableData['phone']);
        $ordersTableData['name'] = $carOrdersTableData['organization_ceo'];

        DB::beginTransaction();
        try {

            $order =  Order::create($ordersTableData);

            $carOrdersTableData['type'] = 'organization';
            $carOrdersTableData['payment_type'] = 'finance';
            $carOrdersTableData['order_id'] = $order->id;

            $carOrdersTableData['cars'] = json_encode($request['cars']);
            CarOrder::create($carOrdersTableData);
            DB::commit();
            $this->sendEmailToAdmin($order);


        } catch (\Throwable $th) {
            // dd($th->getMessage());
            DB::rollBack();
            return response()->json(['error' => "something went wrong"], 500);
        }
    }

    public function corporateCash(Request $request){

        $carOrdersTableData = $request->validate([
            'cars.*.car_name' => ['bail','required', 'string'],
            'cars.*.count' => ['bail','required', 'integer'],
            'organization_name' => ['bail','required', 'string', 'max:255'],
            'organization_email' => ['bail','required', 'max:255', 'email'],
            'organization_ceo' => ['bail','required', 'max:255'],
            'phone' => ['bail','required', 'numeric'],
        ]);

        $ordersTableData['type'] = 'car';
        $ordersTableData['phone'] = convertArabicNumbers($carOrdersTableData['phone']);
        $ordersTableData['name'] = $carOrdersTableData['organization_ceo'];

        DB::beginTransaction();
        try {

            $order =  Order::create($ordersTableData);

            $carOrdersTableData['type'] = 'organization';
            $carOrdersTableData['payment_type'] = 'cash';
            $carOrdersTableData['order_id'] = $order->id;

            $carOrdersTableData['cars'] = json_encode($request['cars']);
            CarOrder::create($carOrdersTableData);
            DB::commit();
            $this->sendEmailToAdmin($order);


        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => "something went wrong"], 500);
        }

    }

    public function createUnAvailableCar()
    {
        $cities = City::select('id', 'name_' . getLocale())->get();
        return vieW('web.unavailable-car', compact('cities'));
    }

    public function unAvailableCar(Request $request){

        $data = $request->validate([
            'name'          =>     ['bail', 'required', 'max:255'],
            'phone'         =>     ['bail', 'required', 'numeric'],
            'car_name'      =>     ['bail', 'required', 'string'],
            'city_id'       =>     ['bail', 'required', 'exists:App\Models\City,id'],
        ]);

        $data['type'] = 'unavailable_car';
        $data['phone'] = convertArabicNumbers($data['phone']);

        try {
            //code...
            $order = Order::create($data);
            $this->sendEmailToAdmin($order);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error" => "something went wrong"], 500);
        }

    }


    public function sendEmailToAdmin($order)
    {
        // Mail::send('mails.new-order', compact('order') ,function($message) {
        //     $message->to([settings()->get('email')])
        //         ->subject(__('New order'));
        // });
        Mail::to([settings()->getSettings('email')])->send(new NewOrder($order));
    }

}
