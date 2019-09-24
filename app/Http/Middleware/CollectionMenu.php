<?php

namespace App\Http\Middleware;

use App\Models\WordSection;
use Closure;

class CollectionMenu
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
        \Menu::make('CollectionMenu', function($menu){
            $section = WordSection::withDepth()->having('depth', '=', 0)->get();
            foreach($section as $item){
                $menu->add($item->name, ['route'=>["word-collection.section", $item->code]]);
            }
        });

        return $next($request);
    }
}
