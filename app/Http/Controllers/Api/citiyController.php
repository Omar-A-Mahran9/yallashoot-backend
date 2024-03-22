<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class citiyController extends Controller
{
    //
    public function index(){
        $cities = City::get();

        return $this->success(data: $cities);

    }
}
