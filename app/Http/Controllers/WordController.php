<?php

namespace App\Http\Controllers;

use App\Models\Example;
use App\Models\Synonym;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function show($code)
    {
        $word = Word::where("name", "=", $code)->first();

        return view('partials.word_info', compact('word'));
    }

    public function example($code)
    {
        $examples = Example::where('word', '=', $code)->first();

        if($examples)
            $items = $examples->items;
        else
            $items = [];

        return view("partials.word_example", ['examples' => $items]);
    }

    public function synonyms($code)
    {
        $synonyms = Synonym::where('word', '=', $code)->where("synonym","!=", "")->get();

        return view("partials.word_synonyms", compact('synonyms'));
    }
}
