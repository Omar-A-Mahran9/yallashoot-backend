<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class SharedController extends Controller
{
    /** shared means that functions that exist in dashboard and web **/


    public function getParentModels(Brand $brand)
    {
        $parentModels = $brand->parentModels()->select('id','name_'.getLocale())->get();

        return response()->json([
            'models' => $parentModels
        ]);
    }


    public function getModelCategories(CarModel $model)
    {
        $categories = $model->categories()->select('id','name_'.getLocale())->get();

        return response()->json([
            'categories' => $categories
        ]);
    }


    public function getCategoryCars(Category $category)
    {
        $cars = $category->cars()->select('id','name_'.getLocale())->get();

        return response()->json([
            'cars' => $cars
        ]);
    }

    /** shared means that functions that exist in dashboard and web **/

}
