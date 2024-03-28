<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCountriesRequest;
use App\Http\Requests\Dashboard\UpdateCountriesRequest;
use App\Models\Continent;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_countries');

        if ($request->ajax())
        {
            $data = getModelData( model: new Country() );

            return response()->json($data);
        }

        return view('dashboard.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
        $continents=Continent::get();
        $this->authorize('create_countries');
        return view('dashboard.countries.create',compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountriesRequest $request)
    {
        $this->authorize('create_countries');
        $data=$request->validated();

        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Countries");

        Country::create($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $continents=Continent::get();
        $this->authorize('show_countries');
        return view('dashboard.countries.show',compact('country','continents'));
    }

 
    public function edit(Country $country)
    {
        $continents=Continent::get();
        $this->authorize('update_countries');
        return view('dashboard.countries.edit',compact('country','continents'));
    }

  
    public function update(UpdateCountriesRequest $request, Country $country)
    {
        $this->authorize('update_countries');
        $data=$request->validated();
        if ($request->file('main_image'))
        {
            deleteImage( $country['main_image'] , "Countries");
            $data['main_image'] = uploadImage( $request->file('main_image') , "Countries");
        }

        $country->update($data);
    }

    
    public function destroy(Country $country ,Request $request)
    {
        $this->authorize('delete_countries');

        if($request->ajax())
        {
            $country->delete();
            deleteImage($country->main_image , 'Countries' );
        }
    }
}
