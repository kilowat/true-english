<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GrammarSectionPost;
use App\Models\GrammarSection;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminGrammarSectionController extends AdminController
{
    public function index()
    {
        return view("admin.pages.grammar_sections_index");
    }

    public function dataList()
    {
        $section = GrammarSection::query()->orderBy("id", "desc");;

        return Datatables::of($section)
            ->addColumn('action', function ($section) {
                $btn_str =  '<a href="'.route('admin.grammar-section.edit', $section->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.="<br>";
                $btn_str.='<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.grammar-section.delete', $section->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->removeColumn('created_at')
            ->editColumn('picture', function ($section) {
                return '<img src="'.$section->previewPicture.'" width="100">';
            })
            ->editColumn('active', function($section){
                if($section->active){
                    $label = "success";
                    $active = "Активно";
                }else{
                    $label = "warning";
                    $active = "Не активно";
                }

                return '<span class="label label-'.$label.'">'.$active.'</span>';
            })
            ->rawColumns(['action', 'picture', 'active'])
            ->make(true);
    }

    public function add()
    {
        return view("admin.pages.grammar_section_add");
    }

    public function store(GrammarSectionPost $request)
    {
        $created = GrammarSection::create($request->all());

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function edit($id)
    {
        $section = GrammarSection::findOrFail($id);

        return view('admin.pages.grammar_section_edit', compact('section'));
    }

    public function update($id, GrammarSectionPost $request)
    {
        $created = GrammarSection::find($id)->update($request->all());

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }


    public function delete($id)
    {
        GrammarSection::destroy($id);

        return redirect()->back();
    }

}
