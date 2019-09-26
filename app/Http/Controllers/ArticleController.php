<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $count = 20;

    public function index($tag = null)
    {
        if ($tag) {
            $articles = Article::with('tagged')
                ->withAnyTag($tag)
                ->orderBy('created_at', 'desc')
                ->paginate($this->count);
        } else {
            $articles = Article::with('tagged')
                ->orderBy('created_at', 'desc')
                ->paginate($this->count);
        }

        return view("pages.article_index", compact('articles', 'tag'));
    }

    public function detail($code){
         $article = Article::where("code", "=", $code)->first();

         return view("pages.article_detail", compact('article'));
    }
}
