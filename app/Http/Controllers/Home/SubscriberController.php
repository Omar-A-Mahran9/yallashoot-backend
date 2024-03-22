<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => [ 'required' , "email:rfc,dns" , 'max:255' , 'unique:subscribers']
        ]);

        Subscriber::create($data);

    }
}
