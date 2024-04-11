<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreChannelRequest;
use App\Http\Requests\Dashboard\UpdateChannelRequest;
use App\Models\channel;
use App\Models\Satellite;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_channel');

        if ($request->ajax())
        {
            $data = getModelData(model: new channel());
      
             return response()->json($data);
        }

        return view('dashboard.channels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create_channel');
 
      return view('dashboard.channels.create',);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChannelRequest $request)
    {
        $this->authorize('create_channel');
        $data= $request->validated();
        unset($data['deletedsatellites']);
        unset($data['satellites']);
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Channels");
 
        $chanel=channel::create($data);
          $dat=$request->validated();
        $deletestalite=$request->deletedsatellites[0];
        $deletedIdsArray = explode(',', $deletestalite);
        $deletedIdsArray = array_map('intval', $deletedIdsArray);
        if($deletestalite){
            foreach ($deletedIdsArray as $id) {
                $satellite=Satellite::findOrFail($id);
                $satellite->delete();
             }
        }
          foreach ($dat['satellites'] as $statlite)
        {
        $statlite['channel_id']=$chanel->id;

         $statliteitem=Satellite::find($statlite['id']);
         if($statliteitem){
             $statliteitem->update($statlite);
         }
         else{
            Satellite::create($statlite);
         }

    }
}

 
    public function show(channel $channel)
    {
    
     
            $this->authorize('show_coaches');
     
            $satellites = Satellite::where('channel_id',$channel->id)->get();

            return view('dashboard.channels.show', compact('satellites','channel'));     
    }

   
    public function edit(channel $channel)
    {
        $this->authorize('update_channel');
        $satellites = Satellite::where('channel_id',$channel->id)->get();

      return view('dashboard.channels.edit', compact('satellites','channel'));
    }

  
    public function update(UpdateChannelRequest $request, channel $channel)
    {
          $this->authorize('update_channel');
        $data= $request->validated();
        unset($data['deletedsatellites']);
        unset($data['satellites']);
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Channels");
 
        $channel->update($data);
        $dat=$request->validated();
        $deletestalite=$request->deletedsatellites[0];
        $deletedIdsArray = explode(',', $deletestalite);
        $deletedIdsArray = array_map('intval', $deletedIdsArray);
        if($deletestalite){
            foreach ($deletedIdsArray as $id) {
                $satellite=Satellite::findOrFail($id);
                $satellite->delete();
             }
        }
          foreach ($dat['satellites'] as $statlite)
        {
        $statlite['channel_id']=$channel->id;

         $statliteitem=Satellite::find($statlite['id']);
         if($statliteitem){
             $statliteitem->update($statlite);
         }
         else{
            Satellite::create($statlite);
         }

    }
    }

 
    public function destroy(Request $request, channel $channel)
    {    
            $this->authorize('delete_channel');
    
            if($request->ajax())
            {
                $channel->delete();
                deleteImage($channel->main_image , 'Coaches' );
            }
       
    }
}
