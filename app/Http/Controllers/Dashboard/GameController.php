<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\GameStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreGameRequest;
use App\Http\Requests\Dashboard\UpdateGameRequest;
use App\Models\channel;
use App\Models\Country;
use App\Models\Game;
use App\Models\League;
use App\Models\Playground;
use App\Models\Team;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_games');
  
        if ($request->ajax())
        {
            $data = getModelData( model: new Game() );

            return response()->json($data);
        }
        return view('dashboard.games.index');

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create_games');

        $leagues=League::get();
        $teams=Team::get();
        $countries=Country::get();
        $playgrounds=Playground::get();
        $channels=channel::get();
        $statues=GameStatus::values();
        

        return view('dashboard.games.create',compact('playgrounds','channels','leagues','teams','countries','statues'));
       
    }

 
    public function store(StoreGameRequest $request)
    {
        $this->authorize('create_games');
        $request->validated();
        $data = $request->except('channel_ids');
        $game=Game::create($data);
        $game->channels()->attach( $request['channel_ids'] ?? [] );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        $this->authorize('show_games');

        $leagues=League::get();
        $teams=Team::get();
        $countries=Country::get();
        $playgrounds=Playground::get();
        $channels=channel::get();
        $statues=GameStatus::values();
        $selectedchannelssIds = $game->channels->pluck('id')->toArray();


        return view('dashboard.games.show',compact('selectedchannelssIds','game','playgrounds','channels','leagues','teams','countries','statues'));
       
    }

  
    public function edit(Game $game)
    {
        $this->authorize('update_games');

        $leagues=League::get();
        $teams=Team::get();
        $countries=Country::get();
        $playgrounds=Playground::get();
        $channels=channel::get();
        $statues=GameStatus::values();
        $selectedchannelssIds = $game->channels->pluck('id')->toArray();


        return view('dashboard.games.edit',compact('selectedchannelssIds','game','playgrounds','channels','leagues','teams','countries','statues'));
       
    }

   
    public function update(UpdateGameRequest $request, Game $game)
    {
        $this->authorize('create_games');
        $request->validated();
        $data = $request->except('channel_ids');
        $game->update($data);
        $game->channels()->sync( $request['channel_ids'] ?? [] );
    }
 
    public function destroy(Request $request, Game $game)
    {
        $this->authorize('delete_games');

        if($request->ajax())
        {
            $game->delete();
         }    
        
    }
}
