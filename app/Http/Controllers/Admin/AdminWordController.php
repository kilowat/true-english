<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 14.09.2019
 * Time: 22:13
 */

namespace App\Http\Controllers\Admin;


use App\Models\Word;

class AdminWordController extends AdminController
{
    public function index(){
        $words = Word::get();
        return view('admin.pages.word_index', ['words' => $words]);
    }
}