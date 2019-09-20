<?php

namespace App\Widgets;

use App\Models\WordCard;
use Arrilot\Widgets\AbstractWidget;

class TopCards extends AbstractWidget
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
        $cards = WordCard::with('words')->withCount('words')->orderBy("created_at", "desc")->take($this->take)->get();

        return view('widgets.top_cards', [
            'cards' => $cards,
        ]);
    }
}
