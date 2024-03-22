<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreNewsRequest;
use App\Http\Requests\Dashboard\UpdateNewsRequest;
use App\Models\News;
use App\Models\NewsSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_news');

        if ($request->ajax())
        {
            $data = getModelData( model: new News() );

            return response()->json($data);
        }

        return view('dashboard.news.index');
    }

    public function create()
    {
        $this->authorize('create_news');

        return view('dashboard.news.create');
    }


    public function edit(News $news)
    {
        $this->authorize('update_news');

        return view('dashboard.news.edit',compact('news'));
    }


    public function show(News $news)
    {
        $this->authorize('show_news');

        return view('dashboard.news.show',compact('news'));
    }

    public function store(StoreNewsRequest $request)
    {
        $this->authorize('create_news');

        $data = $request->validated();

        if ($request->file('main_image'))
            $data['main_image'] = uploadImage( $request->file('main_image') , "News");

        if ($request->file('highlighted_image'))
            $data['highlighted_image'] = uploadImage( $request->file('highlighted_image') , "News");

        $data['highlighted_news'] = $request['highlighted_news'] == "on";

        $news = News::create($data);

        NewsSubscriber::get()->map( function ($user) use ($news) {

            try {

                Mail::send('mails.newsletter', compact('news') ,function($message) use ($news , $user){
                    $message->to([$user->email])
                        ->subject($news->title);
                });

            } catch (\Throwable $th) {
                dd($th->getMessage()) ;
            }

        });

    }

    public function update(UpdateNewsRequest $request , News $news)
    {
        $this->authorize('update_news');

        $data = $request->validated();

        if ($request->file('main_image'))
        {
            deleteImage( $news['main_image'] , "News");
            $data['main_image'] = uploadImage( $request->file('main_image') , "News");
        }

        if ($request->file('highlighted_image'))
        {
            deleteImage( $news['highlighted_image'] , "News");
            $data['highlighted_image'] = uploadImage( $request->file('highlighted_image') , "News");
        }

        $data['highlighted_news'] = $request['highlighted_news'] == "on";

        $news->update($data);
    }


    public function destroy(Request $request, News $news)
    {
        $this->authorize('delete_news');

        if($request->ajax())
        {
            $news->delete();
        }
    }
}
