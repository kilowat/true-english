<?php

namespace App\Http\Controllers;

use App\Models\WordCard;
use App\Models\WordSection;
use Illuminate\Http\Request;

class WordCollectionController extends FrontController
{
    private $paginateCount = 12;

    public function list()
    {
        $sections = WordSection::withDepth()->having('depth', '=', 0)->get();

        return view("pages.word_collection_list", ['sections' => $sections]);
    }

    public function detail($parent_section_code, $current_section_code ,$element_code)
    {
        return view("pages.word_collection_detail");
    }

    public function section($section_code, $parent_section = null){
        $current_section = WordSection::where("code", "=", $section_code)->first();

        $this->checkNeedShow404($current_section);

        $sections = WordSection::where('parent_id', '=', $current_section->id)
            ->paginate($this->paginateCount);

        $data =  [
            "sections" => $sections,
            "current_section" => $current_section
        ];

        return view('pages.word_collection_section', $data);
    }

    public function elements($parent_code, $section_code ){

        $section = WordSection::where("code", "=", $section_code)->first();

        $this->checkNeedShow404($section);

        $elements = WordCard::where("section_id" , "=", $section->id)->get();

        $data = [
            'parent_section_code' => $parent_code,
            'section' => $section,
            'elements' => $elements,
        ];

        return view('pages.word_collection_elements', $data);
    }
}
