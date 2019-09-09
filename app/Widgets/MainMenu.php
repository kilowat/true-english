<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Route;

class MainMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        [
            "route_name" => "page.home",
            "name" => "Главная",
        ],
        [
            "route_name" => "word-collection.list",
            "name" => "Сборники слов"
        ],
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        foreach($this->config as & $item){
            $item["link"] = route($item["route_name"]);
            $current_prefix = explode('.', Route::currentRouteName())[0];
            $item_prefix = explode('.', $item["route_name"])[0];
            $item["selected"] = $current_prefix == $item_prefix;
        }

        //
        return view('widgets.main_menu', [
            'config' => $this->config,
        ]);
    }
}
