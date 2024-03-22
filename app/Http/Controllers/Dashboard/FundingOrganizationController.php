<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FundingOrganization;
use Illuminate\Support\Facades\DB;

class FundingOrganizationController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('view_funding_organizations');

        if ($request->ajax())
        {
            $data = getModelData( model: new FundingOrganization() );

            return response()->json($data);
        }
        return view('dashboard.funding_organizations.index');
    }


    public function create()
    {
        $this->authorize('create_funding_organizations');
        return view('dashboard.funding_organizations.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create_funding_organizations');

        $data=  $request->validate([
            // 'image'            => ['required','mimes:jpeg,jpg,png,gif,svg','max:5120'],
            'image'            => ['required','file','max:5120'],
            'name_ar'          => ['required','string','max:255','unique:funding_organizations'],
            'name_en'          => ['required','string','max:255','unique:funding_organizations'],
            'offer_ar'         => ['required','string'],
            'offer_en'         => ['required','string'],
        ]);

        $data['status'] = $request['status'] == "on";

        if ($request->file('image'))
            $data['image'] = uploadImage( $request->file('image') , "FundingOrganizations");


        try {
            //code...
            FundingOrganization::create($data);
        } catch (\Throwable $th) {
            //throw $th;
            deleteImage($data['image'], "FundingOrganizations");
            return response()->json(["error" => "something went wrong"], 500);
        }

    }


    public function show(FundingOrganization $fundingOrganization)
    {
        $this->authorize('show_funding_organizations');
        return view('dashboard.funding_organizations.show', compact('fundingOrganization'));
    }


    public function edit(FundingOrganization $fundingOrganization)
    {
        $this->authorize('update_funding_organizations');

        return view('dashboard.funding_organizations.edit', compact('fundingOrganization'));

    }


    public function update(Request $request, FundingOrganization $fundingOrganization)
    {
        $this->authorize('update_funding_organizations');

        $data = $request->validate([
            // 'image'             => ['nullable','mimes:jpeg,jpg,png,gif,svg','max:5120'],
            'image'             => ['nullable','file','max:5120'],
            'name_ar'           => ['required','string','max:255','unique:funding_organizations,id,' . $fundingOrganization->id ],
            'name_en'           => ['required','string','max:255','unique:funding_organizations,id,' . $fundingOrganization->id ],
            'offer_ar'          => ['required','string'],
            'offer_en'          => ['required','string'],
        ]);

        $data['status'] = $request['status'] == "on";

        if ($request->file('image'))
        {
            deleteImage( $fundingOrganization['image'] , "FundingOrganizations");
            $data['image'] = uploadImage( $request->file('image') , "FundingOrganizations");
        }

        $fundingOrganization->update($data);
    }


    public function destroy(Request $request, FundingOrganization $fundingOrganization)
    {
        $this->authorize('delete_funding_organizations');

        if($request->ajax())
        {
            $fundingOrganization->delete();
        }

    }
}
