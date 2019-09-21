<?php

namespace App\Widgets;

use App\Models\WordSection;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CollectionWordMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(Request $request)
    {
        $menu_items = WordSection::withDepth()->having('depth', '=', 0)->get();

        return view('widgets.collection_word_menu', [
            'items' => $menu_items,
        ]);
    }
}
