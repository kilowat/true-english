<?php

namespace App\Http\Controllers;

use App\Http\Resources\WordResource;
use App\Models\Page;
use App\Models\Word;
use Illuminate\Http\Request;

class DictController extends Controller
{
    public function __construct()
    {
        $this->middleware('doNotCacheResponse', ['only' => ['dictTableData']]);
    }

    public function dictIndex(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();
        return view("pages.dict_index", compact('page'));
    }

    public function dictTableData(Request $request)
    {
        $perPage = $request->per_page ? $request->per_page : 25;

        $words = Word::query()->with('audio');
        $sort = "name";
        $order ="asc";

        $words->orderBy($sort, $order);

        if($request->like){
            $words->where('name', 'like', $request->like.'%');
        }

        $wordList = $words->paginate($perPage);

        $this->checkNeedShow404($wordList);

        return WordResource::collection($wordList);
    }
}
