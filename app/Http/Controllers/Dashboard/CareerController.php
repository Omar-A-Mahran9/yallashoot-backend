<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCareerRequest;
use App\Http\Requests\Dashboard\UpdateCareerRequest;
use App\Models\Applicant;
use App\Models\Career;
use App\Models\City;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_careers');

        if ($request->ajax()) {
            $data = getModelData(model: new Career(), relations: ['city' => ['id', 'name_' . getLocale()]]);

            return response()->json($data);
        }

        $cities = City::get();


        return view('dashboard.careers.index', compact('cities'));
    }

    public function applicants(Request $request)
    {
 
        $this->authorize('view_careers');

        if ($request->ajax()) {
            $data = getModelData(model: new Applicant(), andsFilters: [['career_id', '=', $request['career_id']]], relations: ['career' => ['id', 'title_' . getLocale(),'city_id']]);
            return response()->json($data);
        } else {
            $careerTitle = Career::find($request['career_id'])->title;
        }

        return view('dashboard.careers.applicants', ['careerTitle' => $careerTitle ?? '']);
    }

    public function create()
    {
        $this->authorize('create_careers');

        $cities = City::select('id', 'name_' . getLocale())->get();

        return view('dashboard.careers.create', compact('cities'));
    }


    public function edit(Career $career)
    {
        $this->authorize('update_careers');

        $cities = City::select('id', 'name_' . getLocale())->get();

        return view('dashboard.careers.edit', compact('career', 'cities'));
    }


    public function show(Career $career)
    {
        $this->authorize('show_careers');
        $career->load('city');
        return view('dashboard.careers.show', compact('career'));
    }

    public function store(StoreCareerRequest $request)
    {

        $this->authorize('create_careers');

        $data = $request->validated();

        $data['status'] = $request['status'] == "on";

        Career::create($data);
    }

    public function update(UpdateCareerRequest $request, Career $career)
    {
        $this->authorize('update_careers');

        $data = $request->validated();
        $data['status'] = $request['status'] == "on";

        $career->update($data);
    }


    public function destroy(Request $request, Career $career)
    {
        $this->authorize('delete_careers');

        if ($request->ajax())
            $career->delete();
    }
}
