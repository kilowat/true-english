<?php

namespace App\Widgets;

use App\Models\Article;
use Arrilot\Widgets\AbstractWidget;

class LastArticles extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    private $take = 4;
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $articles = Article::where('active', '=', 1)
            ->orderBy("created_at", "desc")
            ->take($this->take)->get();

        return view('widgets.last_articles', compact('articles'));
    }
}
