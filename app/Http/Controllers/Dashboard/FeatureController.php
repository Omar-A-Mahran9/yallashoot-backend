<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreFeatureRequest;
use App\Http\Requests\Dashboard\UpdateFeatureRequest;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_features');

        if ($request->ajax()) {

            $features = getModelData(model: new Feature(), searchingColumns: ['name_ar', 'name_en']);

            return response()->json($features);
        }
        return view('dashboard.features.index');
    }

    public function create()
    {
        $this->authorize('create_features');
        return view('dashboard.features.create');
    }

    public function store(StoreFeatureRequest $request)
    {
        $this->authorize('create_features');
        $data = $request->validated();
        Feature::create($data);
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Feature $feature)
    {
        $this->authorize('update_features');
        return view('dashboard.features.edit', compact('feature'));
    }

    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $this->authorize('update_features');

        $data = $request->validated();

        $feature->update($data);
    }

    public function destroy(Request $request, Feature $feature)
    {
        $this->authorize('delete_features');

        if ($request->ajax()) {
            $feature->delete();
        }
    }
}
