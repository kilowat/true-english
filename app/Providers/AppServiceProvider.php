<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\WordCard;
use App\Models\WordSection;
use App\Observers\ArticleObserver;
use App\Observers\WordCardObserver;
use App\Observers\WordSectionObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (App::environment('remote')) {
            URL::forceSchema('https');
        }

        Schema::defaultStringLength(191);

        WordCard::observe(WordCardObserver::class);

        WordSection::observe(WordSectionObserver::class);

        Article::observe(ArticleObserver::class);
    }
}
