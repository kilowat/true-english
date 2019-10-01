<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    public function created(Article $article)
    {
        if(!empty($article->tags_text) && $article->active == 1){
            $arr_tags = explode(",", $article->tags_text);
            $article->tag($arr_tags);
        }
    }

    public function updated(Article $article)
    {
        if(!empty($article->tags_text) && $article->active == 1){
            $arr_tags = explode(",", $article->tags_text);
            $article->retag($arr_tags);
        }
        if($article->active == 0){
            $article->untag();
        }
    }

    public function deleted(Article $article)
    {
        $article->untag();
    }
}
