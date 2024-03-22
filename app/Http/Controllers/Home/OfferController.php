<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Car;
use App\Models\City;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('status' , true)->select('id', 'image', 'title_'.getLocale())->get();
        return view('web.offers', compact('offers'));
    }

    public function show(Offer $offer)
    {
        // $columns = ['id', 'main_image', 'name_'.getLocale(), 'is_new', 'price_field_value', 'price_field_status', 'year', 'fuel_consumption', 'upholstered_seats', 'traction_type', 'have_discount', 'discount_price', 'price'];
        // $cars = Car::select($columns)->where('id', 1)->get();
        $cars = $offer->cars;
        $cities = City::with('branches')->get();
        return view('web.single-offer', compact('offer', 'cars', 'cities'));
    }
}
