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

    public function misc(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();

        return view('pages.misc_index', compact('page'));
    }
}
