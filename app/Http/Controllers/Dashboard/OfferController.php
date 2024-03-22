<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\StoreOfferRequest;
use App\Http\Requests\Dashboard\UpdateOfferRequest;
use App\Models\Car;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_offers');

        if ($request->ajax())
        {
            $data = getModelData( model: new Offer() );

            return response()->json($data);
        }

        return view('dashboard.offers.index');
    }

    public function create()
    {
        $this->authorize('create_offers');

        $cars = Car::select('id','name_' . getLocale(),'main_image')->get();

        
        // $cars = Car::select('id','name_' . getLocale() , 'main_image')->get();


        return view('dashboard.offers.create',compact('cars'));
    }


    public function edit(Offer $offer)
    {
        $this->authorize('update_offers');

        $cars = Car::select('id','name_' . getLocale(),'main_image' )->get();
        // $cars = Car::select('id','name_' . getLocale() , 'main_image')->get();


        return view('dashboard.offers.edit',compact('cars','offer'));
    }


    public function show(Offer $offer)
    {
        $this->authorize('show_offers');

        return view('dashboard.offers.show',compact('offer'));
    }

    public function store(StoreOfferRequest $request)
    {
        $this->authorize('create_offers');

        $data = $request->validated();

        $data['status'] = $request['status'] == "on";

        if ($request->file('image'))
            $data['image'] = uploadImage( $request->file('image') , "Offers");

        $offer = Offer::create($data);

        $offer->cars()->attach( $data['cars'] );

    }

    public function update(UpdateOfferRequest $request , Offer $offer)
    {
        $this->authorize('update_offers');

        $data = $request->validated();

        $data['status'] = $request['status'] == "on";

        if ($request->file('image'))
        {
            deleteImage( $offer['image'] , "Offers");
            $data['image'] = uploadImage( $request->file('image') , "Offers");
        }

        $offer->update($data);

        $offer->cars()->sync( $data['cars'] );

    }


    public function destroy(Request $request, Offer $offer)
    {
        $this->authorize('delete_offers');

        if($request->ajax())
        {
            $offer->delete();
        }
    }
}
