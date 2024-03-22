<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Sector;
use App\Rules\NotNumbersOnly;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_banks');

        if ($request->ajax())
             return response()->json(getModelData(model : new Bank() , andsFilters: [['type', '=', 'bank']],));

        else
            return view('dashboard.banks.index');
    }

    public function create()
    {
        $this->authorize('create_banks');
        $sectors = Sector::get();

        return view('dashboard.banks.create', compact('sectors'));
    }

    public function store(Request $request)
    {
 
        $this->authorize('create_banks');

        $data = $this->validateRequestData();
        if($data['type']=='company'){
            $data['accept_from_other_banks']=true;
        }
        $data['image'] = uploadImage( $request->file('image') ,"Banks");
        $bank =Bank::create($data);
        $bank->attachSectors($data);
    }

    public function validateRequestData()
    {
        $ValidationArray = [
            'image'      => 'required|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
            'name_ar' => ['required','string','unique:banks',new NotNumbersOnly()],
            'name_en' => ['required','string','unique:banks',new NotNumbersOnly()],
            'type' => ['required'],
            'accept_from_other_banks' => 'nullable|boolean|required_if:type,bank',
            'special.*'    => 'required|numeric|min:0',

        ];
        foreach(Sector::get()->pluck('slug') as $sector){
            $ValidationArray[$sector.'.*'] = 'required|numeric|min:0';
 
        }

        return request()->validate($ValidationArray);
    }

    public function edit(Bank $bank)
    {
        $this->authorize('update_banks');
        $bankSectors = $bank->sectors->keyBy('slug');
 
        return view('dashboard.banks.edit',compact('bank', 'bankSectors'));
    }

    public function show($id)
    {
        abort(404);
    }

    public function update(Request $request, Bank $bank)
    {
        $this->authorize('update_banks');

        $data = $this->validateRequestForEditing($bank->id);
        if($data['type']=='company'){
            $data['accept_from_other_banks']=true;
        }
        $data['image'] = $this->updateImage($bank->image);
        $bank->update($data);
        $bank->attachSectors($data);
    }

    public function validateRequestForEditing($bankId)
    {
        $ValidationArray = [
            'image'      => 'mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
            'name_ar' => ['required','string','unique:banks,name_ar,'. $bankId,new NotNumbersOnly()],
            'name_en' => ['required','string','unique:banks,name_en,'. $bankId,new NotNumbersOnly()],
            'type' => ['required'],
            'accept_from_other_banks' => 'nullable|boolean|required_if:type,bank',
            'special.*'    => 'required|numeric|min:0',

        ];
        foreach(Sector::get()->pluck('slug') as $sector){
            $ValidationArray[$sector.'.*'] = 'required|numeric|min:0';
        }

        return request()->validate($ValidationArray);
    }

    public function updateImage($imageName)
    {
        if (request()->hasFile('image') )
        {
            deleteImage($imageName, "Banks");
             return uploadImage( request()->file('image') ,"Banks");
        }else{
            return $imageName;
        }
    }

    public function destroy(Request $request, Bank $bank)
    {
        $this->authorize('delete_banks');

        if($request->ajax())
        {
            $bank->sectors()->detach();
            $bank->delete();
        }
    }
}

