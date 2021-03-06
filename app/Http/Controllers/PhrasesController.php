<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhraseTableDataRequest;
use App\Http\Resources\PhraseResource;
use App\Models\Page;
use App\Models\Phrase;
use App\Models\SentenceForvo;
use Illuminate\Http\Request;

class PhrasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('doNotCacheResponse', ['only' => ['phraseTableData']]);
    }

    public function phrasesIndex(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();
        return view("pages.phrases_index", compact('page'));
    }

    public function phraseTableData(PhraseTableDataRequest $request)
    {
        $sort = $request->column ? $request->column : "word";
        $order = $request->order ? $request->order : "asc";
        $perPage = $request->per_page ? $request->per_page : 25;

        $phrase = Phrase::where("phrases_word.file_name", "!=", "")
            ->leftJoin("phrases_word", 'phrases.file_name', '=','phrases_word.file_name')
            ->where("ru_text", "!=", "")
            ->orderBy($sort, $order);

        if($request->like){
            $phrase->where('word', 'like', $request->like.'%');
        }

        $phrase = $phrase->paginate($perPage);

        $this->checkNeedShow404($phrase);

        return PhraseResource::collection($phrase);
    }

    public function sentenceIndex(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();
        return view("pages.sentences_index", compact('page'));
    }

    public function sentenceTableData(PhraseTableDataRequest $request)
    {
        $sort = $request->column ? $request->column : "word";
        $order = $request->order ? $request->order : "asc";
        $perPage = $request->per_page ? $request->per_page : 25;

        $phrase = SentenceForvo::where("sentence_word.file_name", "!=", "")
            ->leftJoin("sentence_word", 'sentence_forvo.file_name', '=','sentence_word.file_name')
            ->orderBy($sort, $order);

        if($request->like){
            $phrase->where('word', 'like', $request->like.'%');
        }

        $phrase = $phrase->paginate($perPage);

        $this->checkNeedShow404($phrase);

        return PhraseResource::collection($phrase);
    }
}
