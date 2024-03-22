<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\NewsSubscriber;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsSubscriberController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('view_news_subscribers');

        if ($request->ajax())
        {
            $subscribers = getModelData( model: new NewsSubscriber() );

            return response()->json($subscribers);

        }

        return view('dashboard.news_subscribers.index');
    }

    public function destroy(Request $request, NewsSubscriber $newsSubscriber)
    {
        $this->authorize('delete_news_subscribers');
        if($request->ajax())
        {
            $newsSubscriber->delete();
        }

    }
}
