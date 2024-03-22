<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCityRequest;
use App\Http\Requests\Dashboard\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_cities');

        if ($request->ajax())
        {
            $data = getModelData( model: new City() );

            return response()->json($data);
        }

        return view('dashboard.cities.index');
    }

    public function create()
    {
        $this->authorize('create_cities');

        return view('dashboard.cities.create');
    }


    public function edit(City $city)
    {
        $this->authorize('update_cities');
        return view('dashboard.cities.edit',compact('city'));
    }


    public function show($is)
    {
        abort(404);
    }

    public function store(StoreCityRequest $request)
    {
        $this->authorize('create_cities');
        City::create($request->validated());
    }

    public function update(UpdateCityRequest $request , City $city)
    {
        $this->authorize('update_cities');
        $city->update($request->validated());
    }


    public function destroy(Request $request, City $city)
    {
        $this->authorize('delete_cities');

        if($request->ajax())
        {
            $city->delete();
        }
    }
}
