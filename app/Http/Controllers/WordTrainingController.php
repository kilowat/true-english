<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 06.11.2019
 * Time: 17:56
 */

namespace App\Http\Controllers;


use App\Models\Phrase;

class WordTrainingController extends Controller
{
    private $minPhrases = 4;

    public function index($word)
    {
        return view('component.word_training', compact('word'));
    }

    public function ajaxGetPhrase($word, $page = 0)
    {
        $count = Phrase::where("word", $word)
            ->where(function($query){
                $query->havingRaw('COUNT(*) > '.$this->minPhrases);
            })
            ->where('ru_text', '!=', '')
            ->count();

        $ph = Phrase::where("word", $word)
            ->where(function($query){
                $query->havingRaw('COUNT(*) > '.$this->minPhrases);
            })
            ->where('ru_text', '!=', '')
            ->offset($page)
            ->limit(1)
            ->first()
            ->toArray();
        $ph["pagen"] = [
            "current" => $page,
            "total" => $count,
        ];

        return response()->json($ph);
    }
}