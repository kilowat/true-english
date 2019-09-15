<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 13.09.2019
 * Time: 11:12
 */

namespace App\Http\Controllers\Admin;


use App\Services\TextAnalyze\WordParser;

class AdminPageController extends AdminController
{

    public function index(){

        $text = "1 2 3 Performance is always very challenging. Here are a couple suggestions on how to improve the speed of your code.
                Use the whitespace tokenizer, it works better than the general tokenizer
                Use the filter classes on the whole text/corpus, avoid the applyTranformation method calls within the TokenDoc class. They are useful when each token must be validated or transformed. A lot of the filter classes have been re-written to better support the above approach";

        $res = WordParser::getFrequency($text);


        dd($res);

        return view('admin.pages.index');
    }
}