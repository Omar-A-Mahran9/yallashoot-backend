<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Feature;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\FeaturePackage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePackageRequest;
use App\Http\Requests\Dashboard\UpdatePackageRequest;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_packages');

        if ($request->ajax()) {

            $packages = getModelData(model: new Package(), searchingColumns: ['name_ar', 'name_en']);
            return response()->json($packages);
        }
        return view('dashboard.packages.index');
    }

    public function create()
    {
        $this->authorize('create_packages');
        $features = Feature::get();
        return view('dashboard.packages.create', compact('features'));
    }

    public function store(StorePackageRequest $request)
    {
        $this->authorize('create_packages');
        // $data = $request->validated();
        $packageData = $request->except('features', 'value', 'discount_flag');
        $package = Package::create($packageData);
        foreach ($request->features as $key => $feature) {
            $package->feature()->attach($feature, ['value' => $request->values[$key]]);
        }
    }

    public function show(Package $package)
    {
        $this->authorize('show_packages');
        $package->load('features.feature');
        return view('dashboard.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        $this->authorize('update_packages');
        $package->load('features.feature');

        $features = Feature::get();

        return view('dashboard.packages.edit', compact('package', 'features'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        $this->authorize('update_packages');

        $data = $request->validated();
        $packageData = $request->except('features', 'value', 'discount_flag');
        if ($request->discount_flag === 0) {
            $package->update([
                'monthly_price_after_discount' => NULL,
                'annual_price_after_discount' => NULL,
                'discount_from_date' => NULL,
                'discount_to_date' => NULL
            ]);
        }
        $package->update($packageData);
        foreach ($request->features as $key => $feature) {
            $existingPivot = $package->feature()->where('feature_id', $feature)->exists();
            if ($existingPivot) {
                $package->feature()->updateExistingPivot($feature, [
                    'value' => $request->values[$key],
                ]);
            }
            if (!$existingPivot) {
                $package->feature()->attach($feature, ['value' => $request->values[$key]]);
            }
        }
    }

    public function destroy(Request $request, Package $package)
    {
        $this->authorize('delete_tags');

        if ($request->ajax()) {
            $package->delete();
        }
    }
}
