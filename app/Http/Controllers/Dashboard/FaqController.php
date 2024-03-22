<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreFaqRequest;
use App\Http\Requests\Dashboard\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {

        $this->authorize('view_faq');

        if ($request->ajax())
        {

            $data = getModelData( model: new Faq() );

            return response()->json($data);

        }

        return view('dashboard.faq.index');
    }

    public function create()
    {
        $this->authorize('create_faq');

        return view('dashboard.faq.create');
    }


    public function edit(Faq $faq)
    {
        $this->authorize('update_faq');

        return view('dashboard.faq.edit',compact('faq'));
    }


    public function show(Faq $faq)
    {
        $this->authorize('show_faq');

        return view('dashboard.faq.show',compact('faq'));
    }

    public function store(StoreFaqRequest $request)
    {
        $this->authorize('create_faq');
        Faq::create($request->validated());
    }

    public function update(UpdateFaqRequest $request , Faq $faq)
    {
        $this->authorize('update_faq');
        $faq->update($request->validated());
    }


    public function destroy(Request $request, Faq $faq)
    {
        $this->authorize('delete_faq');

        if($request->ajax())
        {
            $faq->delete();
        }
    }
}
