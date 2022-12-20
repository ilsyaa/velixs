<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Metavis;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\PageView;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        PageView::record();
        return Metavis::view('main.index', [
            'latest_article' => Blog::whereNotNull('published_at')->where('content_type', 'article')->orderBy('created_at', 'desc')->limit(6)->get(),
            'latest_tutorial' => Blog::whereNotNull('published_at')->where('content_type', 'tutorial')->orderBy('created_at', 'desc')->limit(6)->get(),
        ]);
    }
}
