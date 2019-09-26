<?php

namespace App\Http\Controllers;

use App\Models\AnkiCard;
use Illuminate\Http\Request;

class AnkiCardController extends Controller
{
    private $count = 20;

    public function index($tag = null){
        if($tag){
            $cards = AnkiCard::with('tagged')->withAnyTag($tag)->paginate($this->count);
        }else{
            $cards = AnkiCard::with('tagged')->paginate($this->count);
        }

        return view("pages.anki_index", compact('cards', 'tag'));
    }
}
