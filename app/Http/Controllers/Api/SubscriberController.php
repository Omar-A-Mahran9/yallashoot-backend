<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\StoreSubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(StoreSubscriberRequest $request)
    {
        try
        {
            Subscriber::create($request->all());
            return $this->success(data: []);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }
}
