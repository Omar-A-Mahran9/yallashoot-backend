<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreModelRequest;
use App\Http\Requests\Dashboard\UpdateModelRequest;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_models');

        if ( $request->ajax() )
        {
            $relations     = [ 'brand' => [ 'id','name_' . getLocale() ] ];
            $models        = getModelData( model : new CarModel() , relations : $relations );

            return response()->json($models);
        }

        return view('dashboard.models.index');
    }

    public function create()
    {
        $this->authorize('create_models');
        $brands        = Brand::select('id','name_' . getLocale())->get();

        return view('dashboard.models.create',compact('brands'));
    }


    public function store(StoreModelRequest $request)
    {
        $this->authorize('create_models');

        $data = $request->validated();


        $model = CarModel::where('name_ar',$data['name_ar'])->where('brand_id',$data['brand_id'])->first();
        $modelen = CarModel::where('name_en',$data['name_en'])->where('brand_id',$data['brand_id'])->first();

        if($model||$modelen)
        {
            throw ValidationException::withMessages([
                'name_ar' => __("Name in arabic already exists"),
                'name_en' => __("Name in english already exists")
            ]);
        }

        CarModel::create($data);

    }

    public function show(CarModel $model)
    {
        $this->authorize('show_models');

        return view('dashboard.models.show',compact('model'));
    }

    public function edit(CarModel $model)
    {
        $this->authorize('update_models');

        $brands        = Brand::select('id','name_' . getLocale())->get();

        return view('dashboard.models.edit',compact('model','brands'));
    }

    public function update(UpdateModelRequest $request, CarModel $model)
    {
        $this->authorize('update_models');

        $data = $request->validated();

        $existentModel = CarModel::where('name_ar',$data['name_ar'])->where('brand_id',$data['brand_id'])->where('id','!=',$model->id)->first();

        if($existentModel)
        {
            throw ValidationException::withMessages([
                'name_ar' => __("Name in arabic already exists")
            ]);
        }

        $existentModel = CarModel::where('name_en',$data['name_en'])->where('brand_id',$data['brand_id'])->where('id','!=',$model->id)->first();
        if($existentModel)
        {
            throw ValidationException::withMessages([
                'name_en' => __("Name in english already exists")
            ]);
        }

        $model->update($data);
    }

    public function destroy(Request $request, CarModel $model)
    {
        $this->authorize('delete_models');

        if ($request->ajax())
        {
            if($model->cars->count() > 0)
                throw ValidationException::withMessages([
                    'model' => __("This model is assigned to cars and can't be deleted")
                ]);

            $model->delete();
        }

    }


}
