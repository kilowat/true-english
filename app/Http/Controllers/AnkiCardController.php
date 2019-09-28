<?php

namespace App\Http\Controllers;

use App\Models\AnkiCard;
use Illuminate\Http\Request;

class AnkiCardController extends Controller
{
    private $count = 20;

    public function index($tag = null)
    {
        if($tag){
            $cards = AnkiCard::with('tagged')
                ->withAnyTag($tag)
                ->orderBy("created_at", "desc")
                ->paginate($this->count);
        }else{
            $cards = AnkiCard::with('tagged')
                ->orderBy("created_at", "desc")
                ->paginate($this->count);
        }

        return view("pages.anki_index", compact('cards', 'tag'));
    }
}
