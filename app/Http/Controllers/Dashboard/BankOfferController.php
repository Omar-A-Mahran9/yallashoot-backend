<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Bank;
use App\Models\BankOffer;
use App\Models\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class BankOfferController extends Controller
{
    public function index(Request $request)
    {
  

        if ($request->ajax()){
            if(isset(request()->bank_id) && request()->bank_id != null && request()->bank_id != ''){
                return response()->json(getModelData( model: new BankOffer() , andsFilters: [ [ 'bank_id' , '=' , request()->bank_id ] ]  ,relations:[ 'bank' => ['id','name_' .getLocale()]],));
                
            }else{
                return response()->json(getModelData( model: new BankOffer() ,relations:[ 'bank' => ['id','name_' .getLocale()]],));

            }
        }else{
            return view('dashboard.bank_offers.index');
        }
    }

    public function create(){
        
        $banks =  Bank::get();
        $sectors =  Sector::get();
        $brnads = Brand::select('name_'.getLocale(),'id')->get();

        return view('dashboard.bank_offers.create',compact('banks','brnads','sectors'));
    }

    

    public function validateRequestData()
    {
        $ValidationArray = [
            // 'image'      => 'required|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'image'      => 'required|file|max:2048',
            'title_ar'    => 'required | string | max:255 ',
            'title_en'    => 'required | string | max:255 ',
            'description_ar'    => 'required | string',
            'description_en'    => 'required | string',
            'from'    => 'required | date',
            'to'    => 'required | date | after:from',
            'bank_id' => ['required',Rule::in(Bank::pluck('id'))],
            'brand_id.*' => ['required',Rule::in(Brand::pluck('id'))],
        ];
        foreach(Sector::get()->pluck('slug') as $sector){
            $ValidationArray[$sector.'.*'] = 'required|numeric|min:0';
        }

        return request()->validate($ValidationArray);
    }
    public function store(Request $request){
        $data = $this->validateRequestData();

        $checkBrands = collect(DB::select("SELECT 
            bank_offers.id as bank_offer_id,
            bank_offer_brand.brand_id as barnd_id,
            brands.name_".getLocale()." as brand_name,
            bank_offers.from as date_from,
            bank_offers.to as date_to 
            FROM 
                `bank_offer_brand` 
                    JOIN
                        bank_offers ON bank_offer_brand.bank_offer_id = bank_offers.id 
                    JOIN 
                        brands on bank_offer_brand.brand_id = brands.id 
                    JOIN 
                        banks on bank_offers.bank_id = banks.id 
            WHERE 
                bank_offer_brand.brand_id in (".implode(",",$request->brand_id).")
            AND
                banks.id = ".$request->bank_id."
            and 
                bank_offers.to > '".$request->from."';
        "));

        // if(count($checkBrands) > 0){
        //     $checkBrands = $checkBrands->pluck('brand_name')->toArray();
            
        //     return response()->json([
        //         'errors' => [
        //             'brand_id' => ['( '.implode(",",$checkBrands).' ) '.__('These brands have been used before and cannot be used before the expiry date assigned to them  in other offers')]
        //         ]
        //     ],422);
        // }
        
        $data['image'] = uploadImage( $request->file('image') ,"BankOffers");
        

        $bankOffer  = BankOffer::create([
            'image' =>  $data['image'],
            'title_ar' =>  $data['title_ar'],
            'title_en' =>  $data['title_en'],
            'description_ar' =>  $data['description_ar'],
            'description_en' =>  $data['description_en'],
            'from' =>  $data['from'],
            'to' =>  $data['to'],
            'bank_id' =>  $data['bank_id'],
        ]);

        $bankOffer->attachSectors($data);
        
        $bankOffer->brnads()->attach($data['brand_id']??[]);

    }


    public function edit(BankOffer $bankOffer){
        $banks =  Bank::get();
        $bankOffer->brnads = $bankOffer->brnads;
        $bankOffer->sectors = $bankOffer->sectors;
        $selectedBrandIds = $bankOffer->brnads->pluck('id')->toArray();
        
        $sectors =  Sector::get();
        $brnads = Brand::select('name_'.getLocale(),'id')->get();

        return view('dashboard.bank_offers.edit',compact('banks','brnads','sectors','bankOffer','selectedBrandIds'));
    }

    public function validateRequestUpdateData($id)
    {
        $ValidationArray = [
            // 'image'      => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'image'      => 'nullable|file|max:2048',
            'title_ar'    => 'required | string | max:255 ',
            'title_en'    => 'required | string | max:255 ',
            'description_ar'    => 'required | string ',
            'description_en'    => 'required | string ',
            'from'    => 'required | date',
            'to'    => 'required | date | after:from',
            'bank_id' => ['required',Rule::in(Bank::pluck('id'))],
            'brand_id.*' => ['required',Rule::in(Brand::pluck('id'))],
        ];
        foreach(Sector::get()->pluck('slug') as $sector){
            $ValidationArray[$sector.'.*'] = 'required|numeric|min:0';
        }

        return request()->validate($ValidationArray);
    }
    public function update(Request $request,BankOffer $bankOffer){

        $data = $this->validateRequestUpdateData($bankOffer->id);

        $checkBrands = collect(DB::select("SELECT 
            bank_offers.id as bank_offer_id,
            bank_offer_brand.brand_id as barnd_id,
            brands.name_".getLocale()." as brand_name,
            bank_offers.from as date_from,
            bank_offers.to as date_to 
            FROM 
                `bank_offer_brand` 
                    JOIN
                        bank_offers ON bank_offer_brand.bank_offer_id = bank_offers.id 
                    JOIN 
                        brands on bank_offer_brand.brand_id = brands.id 
                    JOIN 
                        banks on bank_offers.bank_id = banks.id 
            WHERE 
                bank_offer_brand.brand_id in (".implode(",",$request->brand_id).")
            and 
                banks.id = ".$request->bank_id."
            and
                bank_offers.to > '".$request->from."'
            and 
            bank_offers.id <> ".$bankOffer->id.";
        "));
        // if(count($checkBrands) > 0){
        //     $checkBrands = $checkBrands->pluck('brand_name')->toArray();
            
        //     return response()->json([
        //         'errors' => [
        //             'brand_id' => ['( '.implode(",",$checkBrands).' ) '.__('These brands have been used before and cannot be used before the expiry date assigned to them  in other offers')]
        //         ]
        //     ],422);
        // }
        
        $bankOfferUpdatedData = [
            'title_ar' =>  $data['title_ar'],
            'title_en' =>  $data['title_en'],
            'description_ar' =>  $data['description_ar'],
            'description_en' =>  $data['description_en'],
            'from' =>  $data['from'],
            'to' =>  $data['to'],
            'bank_id' =>  $data['bank_id'],
        ];
        if($data['image'] = $this->updateImage($bankOffer->image) != null){
            $bankOfferUpdatedData['image'] = $data['image'];
        }
        $bankOffer->update($bankOfferUpdatedData);
      
        $bankOffer->attachSectors($data);
        $bankOffer->brnads()->detach();
        $bankOffer->brnads()->attach($data['brand_id']??[]);

    }

    public function updateImage($imageName)
    {
        if (request()->hasFile('image') )
        {
            deleteImage($imageName, "Banks");
             return uploadImage( request()->file('image') ,"Banks");
        }
    }

    public function destroy(Request $request, BankOffer $bankOffer)
    {
        $this->authorize('delete_banks');

        if($request->ajax())
        {
            $bankOffer->brnads()->detach();
            $bankOffer->detachSectors();
            $bankOffer->delete();
        }
    }
}
