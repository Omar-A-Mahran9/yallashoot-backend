<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreBrandRequest;
use App\Http\Requests\Dashboard\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_brands');

        if ( $request->ajax() ) {

            $brands = getModelData( model: new Brand() , searchingColumns: ['name_ar', 'name_en'] );

            return response()->json($brands);
        }

        return view('dashboard.brands.index');
    }

    public function create()
    {
        $this->authorize('create_brands');
        return view('dashboard.brands.create');
    }


    public function store(StoreBrandRequest $request)
    {
        $this->authorize('create_brands');

        $data = $request->validated();

        if ($request->file('image'))
            $data['image'] = uploadImage( $request->file('image') , "Brands");

        if ($request->file('cover'))
            $data['cover'] = uploadImage( $request->file('cover') , "Brands");


        if ( $request->file('image') && $request['hex_code'])
            $data['hex_code'] = null;


        Brand::create($data);

    }

    public function show(Brand $brand)
    {
        $this->authorize('show_brands');

        return view('dashboard.brands.show',compact('brand'));
    }

    public function edit(Brand $brand)
    {
        $this->authorize('update_brands');

        return view('dashboard.brands.edit',compact('brand'));
    }

    public function update(UpdateBrandRequest $request,Brand $brand)
    {
        $this->authorize('update_brands');

        $data = $request->validated();


        if ($request->file('image'))
        {
            deleteImage( $brand['image'] , "Brands");
            $data['image'] = uploadImage( $request->file('image') , "Brands");
        }

        if ($request->file('cover'))
        {
            deleteImage( $brand['cover'] , "Brands");
            $data['cover'] = uploadImage( $request->file('cover') , "Brands");
        }

        $brand->update($data);


    }

    public function destroy(Request $request,Brand $brand)
    {
        $this->authorize('delete_brands');

        if ($request->ajax())
        {
            if($brand->cars->count() > 0)
                throw ValidationException::withMessages([
                    'brand' => __("This brand is assigned to cars and can't be deleted")
                ]);

            $brand->delete();
        }

    }


}
