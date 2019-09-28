<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 24.09.2019
 * Time: 21:26
 */

namespace App\Http\Controllers;


use App\Models\Grammar;
use App\Models\GrammarSection;
use Illuminate\Http\Request;


class GrammarController extends Controller
{
    public function __construct()
    {
        $this->initMenu();
    }

    public function initMenu()
    {
        \Menu::make('grammarMenu', function($menu){
            $section = GrammarSection::get();
            //dd($this->request->segment());
            foreach($section as $section_item){
                $menu->add($section_item->name, ['route'=>["grammar.section", $section_item->code]]);
            }
        });
    }

    public function index()
    {
        $grammars = Grammar::with("section")->paginate(20);

        return view("pages.grammar_index", compact('grammars'));
    }

    public function section($code)
    {
        $section = GrammarSection::where("code", "=", $code)->first();
        $grammars = Grammar::where("section_id", "=", $section->id)->paginate(20);

        return view("pages.grammar_section", compact('grammars', 'section'));
    }

    public function detail($section, $code)
    {
        $section = GrammarSection::where("code", "=", $code)->first();
        $grammar = Grammar::where("code", "=", $code)->first();

        return view("pages.grammar_detail", compact('grammar', 'section'));
    }
}