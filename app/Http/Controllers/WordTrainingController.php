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
    public function index($word)
    {
        return view('component.word_training', compact('word'));
    }

    public function ajaxGetPhrase($word, $page = 0)
    {
        $ph = Phrase::where("word", $word)
            ->where(function($query){
                $query->havingRaw('COUNT(*) > 4');
            })
            ->where('ru_text', '!=', '')
            ->offset($page)
            ->limit(1)
            ->first()
            ->toArray();

        return response()->json($ph);
    }
}