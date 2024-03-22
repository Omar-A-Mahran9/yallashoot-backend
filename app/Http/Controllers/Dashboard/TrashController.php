<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    private static array $relations = [
        'Car'                   => ['brand'    => ['id' , 'name_ar','name_en' ] ],
        'Order'                 => ['employee' => ['id','name']],
    ];

    public function index($modelName = 'Car')
    {
        $this->authorize('view_recycle_bin');
 
        if ( request()->ajax() ) {

            $model = app('App\\Models\\' . $modelName);
            $data = getModelData( model: $model , relations: TrashController::$relations[$modelName], onlyTrashed: true );

            return  response()->json($data);
        }

        return view('dashboard.trash');
    }


    public function forceDelete($modelName, $id)
    {
        $this->authorize('delete_recycle_bin');

        $model = app('App\\Models\\' . $modelName);

        $model->onlyTrashed()->find($id)->forceDelete();
    }

    public function restore($modelName, $id)
    {
        $this->authorize('restore_recycle_bin');

        $model = app('App\\Models\\' . $modelName);
        $model->onlyTrashed()->find($id)->restore();
        if($modelName == 'Car')
        {
            $car = $model->find($id);
            ( new CarController)->storeBrandCarsTypeCount($car['is_new'], $car['brand_id']);
        }
    }

}
