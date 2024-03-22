<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\City;

class FaqController extends Controller
{

    public function __invoke()
    {
        $faqs = Faq::select('id', 'question', 'answer')->get();
        $cities = City::with('branches')->get();
        return view('web.faq', compact('faqs', 'cities'));
    }

}
