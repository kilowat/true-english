<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\WordCard;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function subtitle($id)
    {
        $card = WordCard::find($id);

        return $card->jsonSubtitles;
    }

    public function words($id){
        $card = WordCard::find($id);

        $this->checkNeedShow404($card);

        $query = Word::whereHas('cards', function($query) use($id){
            $query->where('card_id', '=', $id);
        })->leftJoin('word_card_words', 'words.name', '=', 'word_card_words.word');

        $words = $query->get();

        return json_encode($words);
    }
}
