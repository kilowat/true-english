<?php

namespace App\Widgets;

use App\Http\Requests\WordTableDataRequest;
use Arrilot\Widgets\AbstractWidget;

class WordLimit extends AbstractWidget
{
    private $limit = [
        50 => 50,
        100 => 100,
        1000 => 1000,
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(WordTableDataRequest $request)
    {
        $limit_select = [];

        foreach($this->limit as $key => $value){

            $is_selected = $request->limit == $value;

            $limit_select[] = [
                "name" => $key,
                "value" => $value,
                "link" => $request->fullUrlWithQuery(["limit" => $value, "page" => 1]),
                "selected" => $is_selected,
            ];
        }

        return view('widgets.word_limit', compact('limit_select'));
    }
}
