<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePlaygroundRequest;
use App\Http\Requests\Dashboard\UpdatePlaygroundRequest;
use App\Models\Playground;
use Illuminate\Http\Request;

class PlaygroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_playground');

        if ($request->ajax())
        {
            $data = getModelData(model: new Playground());
      
             return response()->json($data);
        }

        return view('dashboard.playgrounds.index');
    }
 
    public function create()
    {
        $this->authorize('create_playground');
    
        return view('dashboard.playgrounds.create');
    }

  
    public function store(StorePlaygroundRequest $request)
    {
          $this->authorize('create_playground');
        $data=$request->validated();
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Playgrounds");

        Playground::create($data);

    }

  
    public function show(Playground $playground)
    {
        $this->authorize('show_playground');
        return view('dashboard.playgrounds.show',compact('playground'));

    }
 
    public function edit(Playground $playground)
    {
        $this->authorize('update_playground');
        return view('dashboard.playgrounds.edit',compact('playground'));
    }

    
    public function update(UpdatePlaygroundRequest $request, Playground $playground)
    {
        $this->authorize('update_playground');
        $data=$request->validated();

        if ($request->file('main_image'))
        {
            deleteImage( $playground['main_image'] , "Playgrounds");
            $data['main_image'] = uploadImage( $request->file('main_image') , "Playgrounds");
        }
        $playground->update($data);

    }

  
    public function destroy(Request $request,Playground $playground)
    {
        $this->authorize('delete_playground');

        if($request->ajax())
        {
            $playground->delete();
            deleteImage($playground->main_image , 'Playgrounds' );
        }
    }
}
