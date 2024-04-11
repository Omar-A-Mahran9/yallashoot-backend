<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreTeamsRequest;
use App\Http\Requests\Dashboard\UpdateTeamsRequest;
use App\Models\Coach;
use App\Models\Country;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_team');

        if ($request->ajax())
        {
            $data = getModelData(model: new Team());
      
             return response()->json($data);
        }

        return view('dashboard.teams.index');
    }

   
    public function create()
    {
        $this->authorize('create_team');
        $countries=Country::get();
        $coaches=Coach::get();

        return view('dashboard.teams.create',compact('countries','coaches'));
    }

    
    public function store(StoreTeamsRequest $request)
    {
        $this->authorize('create_team');
        $data=$request->validated();
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Teams");

        Team::create($data);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $this->authorize('show_team');
        $countries=Country::get();
        $coaches=Coach::get();
        return view('dashboard.teams.show',compact('coaches','countries','team'));

    }

   
    public function edit(Team $team)
    {
        $this->authorize('update_team');
        $countries=Country::get();
        $coaches=Coach::get();
        return view('dashboard.teams.edit',compact('coaches','countries','team'));
    }

  
    public function update(UpdateTeamsRequest $request, Team $team)
    {
        $this->authorize('update_team');
        $data=$request->validated();
        if ($request->file('main_image'))
        {
            deleteImage( $team['main_image'] , "Teams");
            $data['main_image'] = uploadImage( $request->file('main_image') , "Teams");
        }

        $team->update($data);

    }

   
    public function destroy(Request $request,Team $team)
    {
        $this->authorize('delete_team');

        if($request->ajax())
        {
            $team->delete();
            deleteImage($team->main_image , 'Teams' );
        }
    }
}
