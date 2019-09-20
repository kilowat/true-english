<?php

namespace App\Providers;

use App\Models\WordCard;
use App\Models\WordSection;
use App\Observers\WordCardObserver;
use App\Observers\WordSectionObserver;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        WordCard::observe(WordCardObserver::class);

        WordSection::observe(WordSectionObserver::class);
    }
}
