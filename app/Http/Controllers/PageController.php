<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends FrontController
{
    public function home(){
        return view('pages.home');
    }
}
