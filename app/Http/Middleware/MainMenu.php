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
        \Menu::make('MainMenu', function($menu) use($request){
            $menu->add('Главная', [ 'route'=>'page.home']);
            $menu->add("Слова и видео", ['route'=>"word-collection.index"]);
            $menu->add("Грамматика", ['route' => 'grammar.index']);
            //$menu->add("Произношение", ['route' => 'prononciation.index']);
            $menu->add("Статьи", ['route' => 'article.index']);
            $menu->add("Фразы", ['route' => 'phrases.index']);
            $menu->add("Предложения", ['route' => 'sentence.index']);
            //$menu->add("Полезное", ['route' => 'page.misc']);
            $menu->add("Словарь", ['route' => 'dict.index']);
            foreach($menu->items as $item){
                if($request->segment(1) && array_key_exists("route", $item->link->path)){
                    if(strpos(route($item->link->path["route"]), $request->segment(1))){
                        $item->active();
                    }
                }
            }
        });

        return $next($request);
    }
}
