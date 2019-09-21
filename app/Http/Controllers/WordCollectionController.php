<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\WordCard;
use App\Models\WordSection;
use Illuminate\Http\Request;

class WordCollectionController extends Controller
{
    private $elementPaginateCount = 20;
    private $wordPaginateCount = 10;

    public function index()
    {
        $sections = WordSection::where('parent_id', '>', 0)->paginate($this->elementPaginateCount);

        return view("pages.word_collection_index", ['sections' => $sections]);
    }

    public function detail($uri, Word $words)
    {
        $arr_uri = explode("/", $uri);
        $element_code = array_pop($arr_uri);
        $section_code = array_pop($arr_uri);

        $card = WordCard::where('code', '=', $element_code)->with('words')->withCount('words')->first();
        $section = WordSection::where('code', '=', $section_code)->first();

        $this->checkNeedShow404($card);
        /*
        $word_list = $words->whereHas('cards', function($query) use($card){
            $query->where('card_id', '=', $card->id);
        })->leftJoin('word_card_words', 'words.name', '=', 'word_card_words.word')
            ->paginate($this->wordPaginateCount);
        */
        return view("pages.word_collection_detail", [
            'card' => $card,
            'section' => $section]);
    }

    public function section($section_code){
        $current_section = WordSection::where("code", "=", $section_code)->first();

        $this->checkNeedShow404($current_section);

        $sections = WordSection::where('parent_id', '=', $current_section->id)
            ->paginate($this->elementPaginateCount);

        $data =  [
            "sections" => $sections,
            "current_section" => $current_section
        ];

        return view('pages.word_collection_section', $data);
    }

    public function elements($parent_code, $section_code ){

        $section = WordSection::where("code", "=", $section_code)->first();

        $this->checkNeedShow404($section);

        $elements = WordCard::where("section_id" , "=", $section->id)->paginate($this->elementPaginateCount);

        $data = [
            'parent_section_code' => $parent_code,
            'section' => $section,
            'elements' => $elements,
        ];

        return view('pages.word_collection_elements', $data);
    }
}
