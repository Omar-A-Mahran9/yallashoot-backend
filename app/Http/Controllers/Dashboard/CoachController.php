<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCoachesRequest;
use App\Http\Requests\Dashboard\UpdateCoachesRequest;
use App\Models\Coach;
use App\Models\Country;
use Illuminate\Http\Request;

class CoachController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('view_coaches');

        if ($request->ajax())
        {
            $data = getModelData(model: new Coach());
      
             return response()->json($data);
        }

        return view('dashboard.coaches.index');
    }

 
    public function create()
    {
        $this->authorize('create_coaches');
        $countries=Country::get();
        return view('dashboard.coaches.create',compact('countries'));

    }

 
    public function store(StoreCoachesRequest $request)
    {
        $this->authorize('create_coaches');
        $data= $request->validated();
        if ($request->file('main_image'))
        $data['main_image'] = uploadImage( $request->file('main_image') , "Coaches");

        Coach::create($data);

    }


    public function show($id)
    {
        $coach = Coach::findOrFail($id); // Assuming League is your model name

        $this->authorize('show_coaches');
        $countries=Country::get();

        return view('dashboard.coaches.show',compact('coach','countries'));
    }

 
    public function edit($id)
    {
        $coach = Coach::findOrFail($id); // Assuming League is your model name
         $this->authorize('update_coaches');
        $countries=Country::get();

        return view('dashboard.coaches.edit',compact('coach','countries'));
    }


    public function update(UpdateCoachesRequest $request, $id)
    {
        $coach = Coach::findOrFail($id); // Assuming League is your model name

         $this->authorize('update_coaches');
        $data=$request->validated();
        if ($request->file('main_image'))
        {
            deleteImage( $coach['main_image'] , "Coaches");
            $data['main_image'] = uploadImage( $request->file('main_image') , "Coaches");
        }

        $coach->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $coach = Coach::findOrFail($id); // Assuming League is your model name

        $this->authorize('delete_coaches');

        if($request->ajax())
        {
            $coach->delete();
            deleteImage($coach->main_image , 'Coaches' );
        }
    }
}
