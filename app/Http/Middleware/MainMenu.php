<?php

namespace App\Http\Middleware;

use Closure;


class MainMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('MainMenu', function($menu){
            $menu->add('Главная', [ 'route'=>'page.home']);
            $menu->add("Сборники слов", ['route'=>"word-collection.index"]);
            $menu->add("Грамматика");
            $menu->add("Упражнения");
            $menu->add("Колоды для Anki");
            $menu->add("Статьи");
            $menu->add("Обратная связь");
        });

        return $next($request);
    }
}
