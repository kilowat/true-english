<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $count = 20;

    public function index($tag = null, Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();

        if ($tag) {
            $articles = Article::with('tagged')
                ->where('active', '=', 1)
                ->withAnyTag($tag)
                ->orderBy('sort', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate($this->count);
        } else {
            $articles = Article::with('tagged')
                ->where('active', '=', 1)
                ->orderBy('sort', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate($this->count);
        }

        return view("pages.article_index", compact('articles', 'tag', 'page'));
    }

    public function detail($code)
    {
         $article = Article::where("code", "=", $code)->first();

         return view("pages.article_detail", compact('article'));
    }
}
