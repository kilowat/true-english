<?php

namespace App\Http\Controllers;

use App\Models\WordSection;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        return view('pages.home');
    }

    public function wordCollection(){
        $sections = WordSection::where('parent_id', '>', 0)->paginate(12);

        return view("pages.word_collection_index", ['sections' => $sections]);
    }

    public function grammar(){
        return view("pages.grammar_index");
    }
}
