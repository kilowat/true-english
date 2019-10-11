<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Pronons;
use Illuminate\Http\Request;

class PrononsController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();
        $elements = Pronons::where('active', '=', 1)
            ->orderBy('sort', 'asc')
            ->paginate(20);

        return view("pages.pronons_index", compact('elements', 'page'));
    }


    public function detail($code)
    {
        $element = Pronons::where("code", "=", $code)->where('active', '=', 1)->first();

        return view("pages.pronons_detail", compact('element'));
    }
}
