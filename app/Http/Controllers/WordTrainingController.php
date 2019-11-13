<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 06.11.2019
 * Time: 17:56
 */

namespace App\Http\Controllers;


use App\Http\Resources\PhraseResource;
use App\Http\Resources\SentenceForvoResource;
use App\Models\Phrase;
use App\Models\SentenceForvo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class WordTrainingController extends Controller
{
    private $minPhrases = 4;

    public function index($word)
    {
        $phrase = Phrase::where('phrases_word.word', '=', $word)
            ->leftJoin('phrases_word', 'phrases_word.file_name', '=','phrases.file_name')
            ->where('phrases.ru_text', '!=', '')
            ->firstOrFail();

        return view('component.word_training', compact('word'));
    }

    public function ajaxGetPhrase($word)
    {
        /*
        $phrase = Phrase::where("word", $word)
            ->where('ru_text', '!=', '')->get();
        */
        $phrase = Phrase::where('phrases_word.word', '=', $word)
            ->leftJoin('phrases_word', 'phrases_word.file_name', '=','phrases.file_name')
            ->where('phrases.ru_text', '!=', '')
            ->get();

        return PhraseResource::collection($phrase);
    }

    public function ajaxGetSentence($word)
    {
        $sentence = SentenceForvo::where('sentence_word.word', '=', $word)
            ->leftJoin('sentence_word', 'sentence_word.file_name', '=','sentence_forvo.file_name')
            ->get();

        return SentenceForvoResource::collection($sentence);
    }

    public function sentence($word)
    {
        $sentence = SentenceForvo::where('sentence_word.word', '=', $word)
            ->leftJoin('sentence_word', 'sentence_word.file_name', '=','sentence_forvo.file_name')
            ->firstOrFail();

        return view('component.word_sentence', compact('word'));
    }
}