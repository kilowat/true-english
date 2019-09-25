<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 24.09.2019
 * Time: 21:26
 */

namespace App\Http\Controllers;


use App\Models\GrammarSection;

class GrammarController extends Controller
{
    public function index(){
        $sections = GrammarSection::get();
        return view("pages.grammar_index", compact('sections'));
    }
}