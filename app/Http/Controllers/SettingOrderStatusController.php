<?php

namespace App\Http\Controllers;

use App\Models\SettingOrderStatus;
use App\Http\Requests\StoreSettingOrderStatusRequest;
use App\Http\Requests\UpdateSettingOrderStatusRequest;

class SettingOrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingOrderStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingOrderStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingOrderStatus  $settingOrderStatus
     * @return \Illuminate\Http\Response
     */
    public function show(SettingOrderStatus $settingOrderStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingOrderStatusRequest  $request
     * @param  \App\Models\SettingOrderStatus  $settingOrderStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingOrderStatusRequest $request, SettingOrderStatus $settingOrderStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingOrderStatus  $settingOrderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingOrderStatus $settingOrderStatus)
    {
        //
    }
}
