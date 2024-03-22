<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Faq;

class NewsController extends Controller
{
    public function show($id)
    {
        try
        {
            $news                      = News::find($id);
            $news['highlighted_image'] = getImagePathFromDirectory($news['highlighted_image'], 'News');
            $news['main_image']        = getImagePathFromDirectory($news['main_image'], 'News');
            $highlightedNews           = News::where('highlighted_news', 1)->orderBy('created_at', 'desc')->take(5)->get();
            $highlightedNews->map(function ($highlighted) {
                $highlighted['highlighted_image'] = getImagePathFromDirectory($highlighted['highlighted_image'], 'News');
                $highlighted['main_image']        = getImagePathFromDirectory($highlighted['main_image'], 'News');
            });
            $data = [
                'news' => $news,
                'latest' => $highlightedNews
            ];
            return $this->success(data: $data);
        } catch (\Exception $e)
        {
            return $this->failure(message: $e->getMessage());
        }
    }

}
