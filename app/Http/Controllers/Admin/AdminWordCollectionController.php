<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 13.09.2019
 * Time: 11:12
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\WordCollectionSectionPost;
use App\Models\WordSection;
use Illuminate\Http\Request;

class AdminWordCollectionController extends AdminController
{

    public function index(){
        $sections = WordSection::withDepth()->get()->toFlatTree();

        return view('admin.pages.word_collection_section_index',[
            'sections' => $sections,
        ]);
    }

    public function addSection(Request $request){
        //dd($request->session());

        return view('admin.pages.word_collection_section_add');
    }

    public function store(WordCollectionSectionPost $request){
        dd($request);
        return redirect()->back();
    }
}