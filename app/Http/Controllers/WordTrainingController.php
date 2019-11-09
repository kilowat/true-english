<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 06.11.2019
 * Time: 17:56
 */

namespace App\Http\Controllers;


use App\Http\Resources\PhraseResource;
use App\Models\Phrase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class WordTrainingController extends Controller
{
    private $minPhrases = 4;

    public function index($word)
    {
        Phrase::where("word", $word)
            ->where('ru_text', '!=', '')->firstOrFail();

        return view('component.word_training', compact('word'));
    }

    public function ajaxGetPhrase($word)
    {

        $phrase = Phrase::where("word", $word)
            ->where('ru_text', '!=', '')->get();

        return PhraseResource::collection($phrase);
    }
}