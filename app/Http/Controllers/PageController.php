<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\WordSection;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();

        return view('pages.home', compact('page'));
    }

    public function prononciation(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();

        return view('pages.prononciation_index', compact('page'));
    }
}
