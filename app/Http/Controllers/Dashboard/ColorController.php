<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreColorRequest;
use App\Http\Requests\Dashboard\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_colors');

        if ( $request->ajax() ) {

            $colors = getModelData( model: new Color() );

            return response()->json($colors);
        }

        return view('dashboard.colors.index');
    }

    public function create()
    {
        $this->authorize('create_colors');
        return view('dashboard.colors.create');
    }

    public function store(StoreColorRequest $request)
    {
        $this->authorize('create_colors');

        $data = $request->validated();

        Color::create($data);
    }

    public function edit(Color $color)
    {
        $this->authorize('update_colors');

        return view('dashboard.colors.edit',compact('color'));
    }

    public function show(Color $color)
    {
        $this->authorize('show_colors');

        return view('dashboard.colors.show',compact('color'));
    }

    public function update(UpdateColorRequest $request,Color $color)
    {
        $this->authorize('update_colors');

        $data = $request->validated();

        if ($request->file('image'))
        {
            deleteImage( $color['image'] , "Colors");
            $data['image'] = uploadImage( $request->file('image') , "Colors");
        }
        else
            $data['image'] = $color['image'];


        if ( $request['color_type'] == 'color' )
            $data['image'] = null;
        else
            $data['hex_code'] = null;


        $color->update($data);


    }

    public function destroy(Request $request,Color $color)
    {
        $this->authorize('delete_colors');
        if ($request->ajax())
        {
            if($color->cars->count() > 0)
                throw ValidationException::withMessages([
                    'color' => __("This color is assigned to cars and can't be deleted")
                ]);

            $color->delete();
        }

    }
}
