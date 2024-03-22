<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $cities = City::whereHas('branches')->with('branches')->get();
        return view('web.contact',compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'name'    => [ 'required' , 'string' , 'max:255' ],
           'email'   => [ 'required' , 'string' , 'max:255' , 'email:rfc,dns' ],
           'title'   => [ 'required' , 'string' , 'max:255' ],
           'message' => [ 'required' , 'string' , 'max:255' ],
        ]);

        ContactUs::create( $data );
    }

}
