<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreBranchRequest;
use App\Http\Requests\Dashboard\UpdateBranchRequest;
use App\Models\Branch;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_branches');

        if ($request->ajax())
        {
            $data = getModelData( model: new Branch()  , relations:[ 'city' => ['id','name_' .getLocale()]], searchingColumns:['name_' . getLocale(), 'address_' . getLocale(), 'phone', 'whatsapp']);

            return response()->json($data);
        }

        $cities = City::get();

        return view('dashboard.branches.index',compact('cities'));
    }

    public function create()
    {
        $this->authorize('create_branches');
        $cities = City::select('id','name_' . getLocale() )->get();

        return view('dashboard.branches.create',compact('cities'));
    }


    public function edit(Branch $branch)
    {
        $this->authorize('update_branches');

        $cities         = City::select('id','name_' . getLocale() )->get();
        [ $lat , $lng ] = getCoordinates($branch['google_map_url']);


        return view('dashboard.branches.edit',compact('branch','cities','lat','lng'));
    }

    public function show(Branch $branch)
    {
        $this->authorize('show_branches');

        [ $lat , $lng ] = getCoordinates($branch['google_map_url']);

        return view('dashboard.branches.show',compact('branch','lat','lng'));
    }

    public function store(StoreBranchRequest $request)
    {
        $this->authorize('create_branches');

        $data = $request->validated();
        $data['whatsapp'] = convertArabicNumbers($data['whatsapp']);
        $data['phone'] = convertArabicNumbers($data['phone']);
        $request->merge(['phone' => $data['phone']]);
        $request->validate([
            'phone' => [
                'required',
                'string',
                 Rule::unique('branches', 'phone'),
            ]]);
        $data['google_map_url'] = "https://www.google.com/maps/?q=" . $request['lat'] . "," . $request['lng'];

        Branch::create($data);

    }

    public function update(UpdateBranchRequest $request , Branch $branch)
    {
        $this->authorize('update_branches');

        $data = $request->validated();
        $data['whatsapp'] = convertArabicNumbers($data['whatsapp']);
        $data['phone'] = convertArabicNumbers($data['phone']);
        $request->merge(['phone' => $data['phone']]);
        $request->validate([
            'phone' => [
                 'string',
                 Rule::unique('branches', 'phone')->ignore($branch->id),
            ]]);
        $data['google_map_url'] = "https://www.google.com/maps/?q=" . $request['lat'] . "," . $request['lng'];

        $branch->update($data);
    }


    public function destroy(Request $request, Branch $branch)
    {
        $this->authorize('delete_branches');

        if($request->ajax())
        {
            $branch->delete();
        }
    }
}
