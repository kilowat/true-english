<?php

namespace App\Http\Controllers;

use App\Models\Example;
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

        return view("partials.word_example", ['examples' => $examples->items]);
    }
}
