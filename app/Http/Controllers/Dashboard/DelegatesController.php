<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Bank;
use App\Models\Delegate;
use App\Models\Delegates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateDelegatesRequest;
use App\Http\Requests\Dashboard\StoreDelegatesRequest;
use Illuminate\Validation\Rule;

class DelegatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_delegates');

        if ($request->ajax()) {
            $delegates = getModelData(model: new Delegate(), relations: ['bank' => ['id', 'name_' . getLocale()]], searchingColumns: ['name', 'phone', 'IBAN']);
            return response()->json($delegates);
        }
        return view('dashboard.delegates.index');
    }

    public function create()
    {
        $this->authorize('create_delegates');
        $banks = Bank::get();
        return view('dashboard.delegates.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDelegatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDelegatesRequest $request)
    {
        $this->authorize('create_delegates');
        $data = $request->validated();
        $data['phone']      = convertArabicNumbers($data['phone']);
        $request->merge(['phone' => $data['phone']]);
        $request->validate([
            'phone' => [
                'required',
                'string',
                 Rule::unique('delegates', 'phone'),
            ]]);
        Delegate::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delegate  $delegate
     * @return \Illuminate\Http\Response
     */
    public function fetchDelegate(Request $request){
       $data= Delegate::find($request->delegatedId);
        return $this->success(data:  $data);
    }
    public function show(Delegate $delegate)
    {
        //
    }
    public function edit(Delegate $delegate)
    {
        $this->authorize('update_delegates');
        $banks = Bank::get();
        return view('dashboard.delegates.edit', compact('delegate', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDelegatesRequest  $request
     * @param  \App\Models\Delegates  $delegates
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDelegatesRequest $request, Delegate $delegate)
    {
        $this->authorize('update_delegates');
        $data          = $request->validated();

        $data['phone'] = convertArabicNumbers($data['phone']);
        $request->merge(['phone' => $data['phone']]);
        $request->validate([
            'phone' => [
                 'numeric',
                Rule::unique('delegates', 'phone')->ignore($delegate->id),
            ],
        ]);
        $delegate->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delegates  $delegates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Delegate $delegate)
    {
        $this->authorize('delete_delegates');
        if ($request->ajax()) {
            $delegate->delete();
        }
    }
}
