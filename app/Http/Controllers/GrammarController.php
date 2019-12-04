<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 24.09.2019
 * Time: 21:26
 */

namespace App\Http\Controllers;


use App\Http\Resources\IngWordTrainingResource;
use App\Models\Grammar;
use App\Models\GrammarSection;
use App\Models\IngWordTrainingModel;
use App\Models\Page;
use Illuminate\Http\Request;


class GrammarController extends Controller
{
    public function __construct()
    {
        $this->middleware('doNotCacheResponse', ['only' => ['getIngFormTraining']]);

        $this->initMenu();
    }

    public function initMenu()
    {
        \Menu::make('grammarMenu', function($menu){
            $section = GrammarSection::where("active", "=", 1)->get();
            //dd($this->request->segment());
            foreach($section as $section_item){
                $menu->add($section_item->name, ['route'=>["grammar.section", $section_item->code]]);
            }
        });
    }

    public function index(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();
        $grammars = Grammar::with("section")
            ->where('active', '=', 1)
            ->orderBy('sort', 'asc')
            ->paginate(20);

        return view("pages.grammar_index", compact('grammars', 'page'));
    }

    public function section($code)
    {
        $section = GrammarSection::where("code", "=", $code)
            ->where('active', '=', 1)
            ->first();
        $grammars = Grammar::where("section_id", "=", $section->id)
            ->where('active', '=', 1)
            ->orderBy('sort', 'asc')
            ->paginate(20);

        return view("pages.grammar_section", compact('grammars', 'section'));
    }

    public function detail($section_code, $code)
    {
        $section = GrammarSection::where("code", "=", $section_code)->where('active', '=', 1)->firstOrFail();
        $grammar = Grammar::where("code", "=", $code)->where('active', '=', 1)->firstOrFail();

        return view("pages.grammar_detail", compact('grammar', 'section'));
    }

    public function getIngFormTraining(Request $request)
    {
        $limit = $request->limit ? $request->limit : 100;
        $words = IngWordTrainingModel::query()
            ->leftJoin('words','word','=','name')
            ->limit($limit)
            ->inRandomOrder()
            ->get();

        $resource = IngWordTrainingResource::collection($words);

        return $resource;
    }
}