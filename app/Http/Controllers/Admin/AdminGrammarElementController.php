<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GrammarElementPost;
use App\Models\Grammar;
use App\Models\GrammarSection;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminGrammarElementController extends AdminController
{
    public function index()
    {
        return view("admin.pages.grammar_element_index");
    }

    public function add(){
        $sections = GrammarSection::get();

        return view("admin.pages.grammar_element_add", compact('sections'));
    }

    public function store(GrammarElementPost $request)
    {
        $created = Grammar::create($request->all());

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function show($id)
    {
        $element = Grammar::findOrFail($id);

        return view('admin.pages.grammar_element_show', compact('element'));
    }

    public function edit($id)
    {
        $sections = GrammarSection::get();
        $element = Grammar::findOrFail($id);

        return view('admin.pages.grammar_element_edit', compact('element', 'sections'));
    }

    public function update($id, GrammarElementPost $request)
    {
        $created = Grammar::find($id)->update($request->all());

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }


    public function delete($id)
    {
        Grammar::destroy($id);

        return redirect()->back();
    }

    public function dataList()
    {
        $grammar = Grammar::query()->orderBy("id", "desc");;

        return Datatables::of($grammar)
            ->addColumn('action', function ($grammar) {
                $btn_str =  '<a href="'.route('admin.grammar-element.edit', $grammar->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.=  '<a href="'.route('admin.grammar-element.show', $grammar->id).'" class="btn btn-xs btn-success btn-action"><i class="glyphicon glyphicon-eye-open"></i> Show</a>';
                $btn_str.='<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.grammar-element.delete', $grammar->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->addColumn('section', function ($grammar) {
                return $grammar->section->name;
            })
            ->removeColumn('created_at')
            ->editColumn('picture', function ($grammar) {
                return '<img src="'.$grammar->previewPicture.'" width="100">';
            })
            ->editColumn('active', function($grammar){
                if($grammar->active){
                    $label = "success";
                    $active = "Активно";
                }else{
                    $label = "warning";
                    $active = "Не активно";
                }

                return '<span class="label label-'.$label.'">'.$active.'</span>';
            })
            ->rawColumns(['action', 'picture','active'])
            ->make(true);
    }
}
