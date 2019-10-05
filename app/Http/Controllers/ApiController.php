<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\WordCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ApiController extends Controller
{
    public function subtitle($id)
    {
        $card = WordCard::find($id);

        return $card->jsonSubtitles;
    }

    public function words($id)
    {
        $card = WordCard::find($id);

        $this->checkNeedShow404($card);

        $query = Word::whereHas('cards', function($query) use($id){
            $query->where('card_id', '=', $id);
        })->leftJoin('word_card_words', 'words.name', '=', 'word_card_words.word');

        $words = $query->get();

        return json_encode($words);
    }

    public function textWords($id, Response $response)
    {
        $card = WordCard::find($id);

        $this->checkNeedShow404($card);

        $query = Word::whereHas('cards', function($query) use($id){
            $query->where('card_id', '=', $id);
        })->leftJoin('word_card_words', 'words.name', '=', 'word_card_words.word');

        $words = $query->get();

        $word_arr = [];

        foreach($words as $word){
            $word_arr[] = $word->name;
        }

        $text = implode(" ", $word_arr);

        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $card->name.".txt"),
            'Content-Length' => sizeof($word_arr)
        ];

        return Response::make($text, 200, $headers);
    }
}
