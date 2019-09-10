<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordCollectionController extends Controller
{
    public function list()
    {
        return view("pages.word_collection_list");
    }

    public function detail($id)
    {
        return view("pages.word_collection_detail");
    }

    public function section($id){
        return view('pages.word_collection_section');
    }
}
