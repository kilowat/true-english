<?php

namespace App\Widgets;

use App\Http\Requests\WordTableDataRequest;
use Arrilot\Widgets\AbstractWidget;

class WordSort extends AbstractWidget
{

    private $sortFields = [
        "freq" => "Частота",
        "name" => "Слово"
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(WordTableDataRequest $request)
    {

        $sort = [];
        foreach($this->sortFields as $column => $label){
            $asc_request = $request->fullUrlWithQuery(['column' => $column, 'order' => "asc"]);
            $desc_request = $request->fullUrlWithQuery(['column' => $column, 'order' => "desc"]);

            $sort[$column] = [
                "name" => $label,
                "asc" => [
                    "link" => $asc_request,
                    "selected" => $request->column == $column && $request->order == "asc"
                ],
                "desc" => [
                    "link" => $desc_request,
                    "selected" => $request->column == $column && $request->order == "desc"
                ]
            ];
        }

        return view('widgets.word_sort', compact('sort'));
    }
}
