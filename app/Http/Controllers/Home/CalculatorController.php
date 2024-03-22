<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Brand;
use App\Models\Sector;

use App\Http\Traits\Calculations;

class CalculatorController extends Controller
{
    use Calculations;

    public function index()
    {
   
        $banks = Bank::get();
        $sectors = Sector::get();
        $brands = Brand::select('id','image','name_en','name_ar', 'car_available_types' )->whereNotNull('car_available_types')->get();
        $data=[
            'banks'=>$banks,
            'sectors'=>$sectors,
            'brands'=>$brands,
        ];
        return view('web.calculator',compact('banks', 'sectors','brands'));

        return $this->success(data: $data);    
    }

    public function calculate(Request $request)
    {
        return $this->calculateByAmount($request);
    }

    public function calculateInstallmentss(Request $request){
        $request->validate([
            "car_id" => "required",
            "bank_id" => "required",
            "brand_id" => "required",
            "model_id" => "required",
            "sector_id" => "required",
            "salary" => "required",
            "commitments" => "required",
            "first_installment" => "required",
            "last_installment" => "required",
            "installment" => "required"
        ]);
        
        $calculateInstallments = $this->calculateInstallments($request);
        $salary = ($request->salary + $request->commitments ) * 1.45;
        if($calculateInstallments['monthly_installment'] > $salary){
            return response()->json([
                'errors' => [
                    'salary' => [
                        __('Please increase the financing period or increase the first payment so that the total monthly installments do not exceed 45% of the salary')
                    ]
                ]
            ],422);
        }
        return $calculateInstallments;
        
    }
}
