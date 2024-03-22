<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;

class CareerController extends Controller
{

    public function index(Request $request)
    {
        $cities  = City::select('id','name_' . getLocale())->get();
        $careers = Career::query()->with('city:id,name_' . getLocale())->whereStatus(true);

        if ( $request['search_term'] )
            $careers->where('title','like', '%' . $request['search_term'] . '%')->orWhere('short_description','like','%' . $request['search_term'] . '%');

        if ( $request['city_id'] )
            $careers->where('city_id','=', $request['city_id']);


        return view('web.join-our-team',[
            'careers' => $careers->paginate(3),
            'cities'  => $cities,
        ]);
    }

    public function show(Career $career)
    {
        return view('web.single-job',compact('career'));
    }

    public function apply(Career $career)
    {
        return view('web.apply-to-job', compact('career'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['bail', 'required', 'max:255'],
            'last_name' => ['bail', 'required', 'max:255'],
            'email' => ['bail','required', 'max:255', "email:rfc,dns"],
            'phone' => ['bail', 'required'],
            'address' => ['bail', 'required', 'max:255'],
            'cv' => ['bail', 'required', 'file'],
            'comment' => ['bail', 'string', 'nullable', 'max:255'],
            'career_id' => []
        ]);
        $data['phone'] = convertArabicNumbers($data['phone']);

        try {

            if ($request->file('cv'))
                $data['cv'] = uploadImage( $request->file('cv') , "Applicants");

            Applicant::create($data);

        } catch (\Throwable $th) {
            deleteImage( $data['cv'] , 'Applicants');
            return response()->json(["error" => "something went wrong"], 500);
        }

    }

}
