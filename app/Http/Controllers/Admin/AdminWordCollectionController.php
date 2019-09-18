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
        $parent_sections = WordSection::where('parent_id', '=', null)->get();

        return view('admin.pages.word_collection_section_add', ['parent_sections' => $parent_sections]);
    }

    public function edit($id){
        $section = WordSection::where('id', '=', $id)->first();

        $parent_sections = WordSection::where('parent_id', '=', null)->get();

        return view('admin.pages.word_collection_section_edit', compact('section', 'parent_sections'));
    }

    public function update($id, WordCollectionSectionPost $request){
        WordSection::find($id)->update($request->all());

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }

    public function store(WordCollectionSectionPost $request){
        if($request->parent_id){
            $parent = WordSection::find($request->parent_id);
            WordSection::create($request->all(), $parent);
        }else{
            WordSection::create($request->all());
        }

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function delete($id){
        dd($id);
        return redirect()->back();
    }
}