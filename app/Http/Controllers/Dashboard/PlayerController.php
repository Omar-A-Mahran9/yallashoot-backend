<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePlayersRequest;
use App\Http\Requests\Dashboard\UpdatePlayersRequest;
use App\Models\Country;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_players');

        if ($request->ajax())
        {
            $data = getModelData(model: new Player());
      
             return response()->json($data);
        }

        return view('dashboard.players.index');
    }

    
    public function create()
    {
        $this->authorize('create_players');
        $countries=Country::get();
        $teams=Team::get();

        return view('dashboard.players.create',compact('countries','teams'));
    }

  
    public function store(StorePlayersRequest $request)
    {
        
        $this->authorize('create_players');
        $data= $request->validated();
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Players");

        Player::create($data);
    }

  
    public function show(Player $player)
    {
        $this->authorize('show_players');
        $countries=Country::get();
        $teams=Team::get();

        return view('dashboard.players.show',compact('countries','teams','player'));
    }

 
    public function edit(Player $player)
    {
        $this->authorize('update_players');
        $countries=Country::get();
        $teams=Team::get();
        return view('dashboard.players.edit',compact('countries','teams','player'));

    }

     
    public function update(UpdatePlayersRequest $request, Player $player)
    {
        $this->authorize('update_players');
        $data=$request->validated();
        if ($request->file('main_image'))
        {
            deleteImage( $player['main_image'] , "Players");
            $data['main_image'] = uploadImage( $request->file('main_image') , "Players");
        }

        $player->update($data);
    }

    
    public function destroy(Request $request, Player $player)
    {
        $this->authorize('delete_players');

        if($request->ajax())
        {
            $player->delete();
            deleteImage($player->main_image , 'Players' );
        }
    }
}
