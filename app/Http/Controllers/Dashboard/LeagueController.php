<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreLeagueRequest;
use App\Http\Requests\Dashboard\UpdateLeagueRequest;
use App\Models\League;
use App\Models\League_category;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_league');
  
        if ($request->ajax())
        {
            $data = getModelData( model: new League() );

            return response()->json($data);
        }
        return view('dashboard.league.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $this->authorize('create_league');

        $types=League_category::get();
        
        return view('dashboard.league.create',compact('types'));
       
    }

 
    public function store(StoreLeagueRequest $request)
    {
        $this->authorize('create_league');
        $data = $request->validated();
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Leagues");
         League::create($data);

    }

   
    public function show($id)
    {
        $leagues = League::findOrFail($id); // Assuming League is your model name
        $types=League_category::get();

        $this->authorize('show_league');

        return view('dashboard.league.show',compact('leagues','types'));
    }
 
    public function edit($id)
    {
        $leagues = League::findOrFail($id); // Assuming League is your model name
        $types=League_category::get();

        $this->authorize('update_league');

        return view('dashboard.league.edit',compact('leagues','types'));
    }

   
    public function update(UpdateLeagueRequest $request, $id)
    {
        $leagues = League::findOrFail($id); // Assuming League is your model name

        $this->authorize('update_league');
        $data = $request->validated();

        if ($request->file('main_image'))
        {
            deleteImage( $leagues['main_image'] , "Leagues");
            $data['main_image'] = uploadImage( $request->file('main_image') , "Leagues");
        }
        $leagues->update($data);
    }

   
    public function destroy(Request $request, League $league)
    {
        $this->authorize('delete_league');

        if($request->ajax())
        {
            $league->delete();
            deleteImage($league->main_image , 'Leagues' );
        }
    }
}
