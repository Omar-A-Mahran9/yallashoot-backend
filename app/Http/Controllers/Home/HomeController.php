<?php

namespace App\Http\Controllers\Home;

use App\Models\Brand;
use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $cars    = Car::take(6)->select( [ 'show_in_home_page' , ... Car::$carCardColumns] )->where('show_in_home_page', 1)->orderBy('created_at', 'desc')->get();
        
        $tags    = Tag::has('cars')->select('id','name_' . getLocale())->get();

        return view('web.index',compact('cars','tags'));
    }

    public function getTagCars(Request $request , Tag $tag)
    {
        return response()->json(['cars' => $tag->cars ]);
    }


}
