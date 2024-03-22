<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Rules\NotNumbersOnly;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function contact(Request $request){

        $request->validate([
            'name'    => ['required' , 'string',new NotNumbersOnly],
            'phone'     => ['required','numeric', 'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);
         $data=$request->toArray();
         $contact=ContactUs::create($data);
        return $this->success(data: $data);

    }
}
