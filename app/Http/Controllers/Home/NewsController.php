<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Faq;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::get();
        $highlightedNews = News::where('highlighted', 1)->orderBy('created_at', 'desc')->take(5)->get();
        // $news = $news->diff($highlightedNews);

        return view('web.latest-news', compact('news', 'highlightedNews'));
    }


    public function show($id)
    {
        $news = News::find($id);
        return view('web.single-news', compact('news'));
    }

}
