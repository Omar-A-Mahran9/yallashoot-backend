<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreContinentsRequest;
use App\Http\Requests\Dashboard\UpdateContinentsRequest;
use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
        $this->authorize('view_continents');
        if ($request->ajax())
        {
            $data = getModelData( model: new Continent() );
             return response()->json($data);
        }
        

        return view('dashboard.continents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create_continents');

         
        return view('dashboard.continents.create');
    }

   
    public function store(StoreContinentsRequest $request)
    {
        $this->authorize('create_continents');
        $data=$request->validated();
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Continents");

        Continent::create($data);
        
    }

 
    public function show(Continent $continent)
    {
        $this->authorize('show_continents');

        return view('dashboard.continents.show',compact('continent'));
    }

  
    public function edit(Continent $continent)
    {
        $this->authorize('update_continents');

        return view('dashboard.continents.edit',compact('continent'));
    }

  
    public function update(UpdateContinentsRequest $request, Continent $continent)
    {
        $this->authorize('update_continents');
        $data=$request->validated();
        if ($request->file('main_image'))
        {
            deleteImage( $continent['main_image'] , "Continents");
            $data['main_image'] = uploadImage( $request->file('main_image') , "Continents");
        }

        $continent->update($data);
    }

 
    public function destroy(Request $request, Continent $continent)
    {
        $this->authorize('delete_continents');

        if($request->ajax())
        {
            $continent->delete();
            deleteImage($continent->main_image , 'Continents' );
        }
    }
}
