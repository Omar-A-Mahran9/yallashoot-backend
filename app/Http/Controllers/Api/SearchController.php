<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResourse;
use App\Models\Car;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        request()->validate([
                'brand_id'=>'required',
                'is_new'=>'required',
                'category_id'=>'required',
        ]);
            try
            {
                $data = Car::where('brand_id', $request->brand)
                ->where('is_new', $request->type)
                ->where('category_id', $request->category)
                ->get();  
                return $this->success(data: $data);
            } catch (\Exception $e)
            {
                return $this->failure(message: $e->getMessage());
            }
        
        
    }


   
}
