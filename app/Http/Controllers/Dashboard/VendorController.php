<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Vendor;
use App\Rules\EnumValue;
use App\Enums\VendorStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Rules\NotNumbersOnly;
use App\Rules\PasswordValidate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_vendors');

        if ($request->ajax())
        {
            $data = getModelData( model: new Vendor() );

            return response()->json($data);
        }

        return view('dashboard.vendors.index');
    }

    public function create()
    {
        $this->authorize('create_vendors');

        $cities = City::get();
        $packages=Package::get();
         return view('dashboard.vendors.create', compact('cities','packages'));
    }


    public function show(Vendor $vendor)
    {
        $packages=Package::get();
        $this->authorize('show_vendors');
        return view('dashboard.vendors.show',compact('vendor','packages'));
    }

    public function edit(Vendor $vendor)
    {
        $this->authorize('update_vendors');

        $cities = City::get();
        $packages=Package::get();
         return view('dashboard.vendors.edit',compact('vendor', 'cities','packages'));
    }

    public function store(Request $request)
    {

        $this->authorize('create_vendors');

        $data = $request->validate([
            'image' => ['required', 'image', 'max:4096'],
            'name' => ['required', 'string','unique:vendors,name', 'max:255',new NotNumbersOnly()],
            'phone' => ['required', 'numeric', 'unique:vendors,phone','regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'another_phone' => ['nullable','unique:vendors,another_phone,', 'numeric','regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'package_id' => ['required','numeric','max:255'],
            'status' => ['required', new EnumValue(VendorStatus::class)],
            'type' => ['required', 'in:individual,exhibition,agency'],
            'city_id' => ['required', 'exists:cities,id'],
            'identity_no' => ['required_if:type,individual', 'unique:vendors,identity_no,', 'nullable', 'digits:10'],
            'commercial_registration_no' => ['required_if:type,agency,exhibition', 'unique:vendors,commercial_registration_no,','nullable', 'numeric'],
            'google_maps_url' => ['nullable', 'url'],
            'password' => ['required', 'string', 'min:8', 'max:255',new PasswordValidate(), 'confirmed'],
            'password_confirmation' => ['required','same:password'],
        ]);
        $data=$request->except('password_confirmation');
        $data['created_by'] = auth()->id();

        $data['phone'] = convertArabicNumbers($data['phone']);
        $request->merge(['phone' =>   $data['phone']]);
        $request->validate([
            'phone' => [
                'required',
                'string',
                 Rule::unique('vendors', 'phone'),
            ]
            ]);
        if($data['another_phone'])
            $data['another_phone'] = convertArabicNumbers($data['another_phone']);
            $request->merge(['phone' =>   $data['another_phone']]);
            $request->validate([
                'another_phone' => [
                     'nullable',
                    'numeric',
                     Rule::unique('vendors', 'another_phone'),
                ]
                ]);
        $data['password'] = Hash::make( $request['password'] );
        $data['image'] = uploadImage($request->file('image'), 'Vendors');

        Vendor::create($data);

    }

    public function update(Request $request , Vendor $vendor)
    {

        $this->authorize('update_vendors');

        $data = $request->validate([
            'image' => ['nullable', 'image', 'max:4096'],
            'name' => [
                'required',
                'string',
                'max:255',
                new NotNumbersOnly(),
                Rule::unique('vendors', 'name')->ignore($vendor->id),
            ],
            
            'phone' => ['required', 'numeric', 'unique:vendors,phone,' . $vendor->id,'numeric','regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'another_phone' => ['nullable','unique:vendors,another_phone,'. $vendor->id, 'numeric','regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'package_id' => ['required','numeric','max:255'],
            'status' => ['required', new EnumValue(VendorStatus::class)],
            'type' => ['required', 'in:individual,exhibition,agency'],
            'city_id' => ['required', 'exists:cities,id'],
            'identity_no' => ['required_if:type,individual','unique:vendors,identity_no,'. $vendor->id, 'nullable', 'numeric','digits:10'],
            'commercial_registration_no' => ['required_if:type,agency,exhibition','unique:vendors,commercial_registration_no,'. $vendor->id, 'nullable', 'numeric'],
            'google_maps_url' => ['nullable', 'url'],
            'password' => ['nullable','exclude_if:password,null','string','min:8','max:255',new PasswordValidate(),'confirmed'],
            'password_confirmation' => ['nullable','exclude_if:password_confirmation,null','same:password'],
        ]);
        $data=$request->except('password_confirmation');

        $data['phone'] = convertArabicNumbers($data['phone']);
        
        if($data['another_phone'])
            $data['another_phone'] = convertArabicNumbers($data['another_phone']);
            
        $request->merge(['phone' =>   $data['phone'],'another_phone'=>$data['another_phone']]);
            $request->validate([
                'phone' => [
                     Rule::unique('vendors', 'phone')->ignore($vendor->id),
                ],
            //     'another_phone' => [
            //         Rule::unique('vendors', 'another_phone')->ignore($vendor->id),
            //    ]
                ]);
        if($request->hasFile('image'))
        {
            deleteImage($vendor->image, 'Vendors');
            $data['image'] = uploadImage($request->file('image'), 'Vendors');
        }

        $vendor->update($data);
    }


    public function destroy(Request $request, Vendor $vendor)
    {
        $this->authorize('delete_vendors');

        if($request->ajax())
        {
            $vendor->delete();
        }
    }
}
