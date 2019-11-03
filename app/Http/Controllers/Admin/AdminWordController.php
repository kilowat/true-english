<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 14.09.2019
 * Time: 22:13
 */

namespace App\Http\Controllers\Admin;


use App\Exports\WordExport;
use App\Http\Requests\WordPost;
use App\Imports\WordImport;
use App\Models\Word;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class AdminWordController extends AdminController
{
    public function index()
    {
        $words = Word::paginate(100);

        return view('admin.pages.word_index', ['words' => $words]);
    }

    public function add()
    {
        return view("admin.pages.word_add");
    }

    public function store(WordPost $request)
    {
        $created = Word::create($request->all());

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function dataList()
    {
        $words = Word::query()->with('audio');

        return Datatables::of($words)
            ->addColumn('audio', function($words){
                if($words->audio)
                    return $words->audio->file_name."<br><audio controls><source src='".$words->audio->url."' type='".$words->audio->mime."'></audio>";
                else
                    return "";
            })
            ->addColumn('action', function ($words) {
                $btn_str =  '<a href="'.route('admin.word.edit', $words->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.='<br>';
                $btn_str.=  '<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.word.delete', $words->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->editColumn('checked', function($words) {
                $control = '<span class="label label-'. ($words->checked ? 'success' : 'warning').'">'. ($words->checked ? 'Проверено' : 'Не проверенно').'</span>';
                $control .= '<input type="checkbox" class="checked-word-input" onclick="setWordChecked('.$words->id.',this)"'.($words->checked ? 'checked=""' : '').'>';
                return $control;
            })
            ->removeColumn('created_at')
            ->rawColumns(['audio','checked' ,'action'])
            ->make(true);
    }

    public function edit($id)
    {
        $word = Word::findOrFail($id);
        return view('admin.pages.word_edit', ['word' => $word]);
    }

    public function update($id, WordPost $request)
    {
        Word::find($id)->update($request->all());

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }

    public function checkUpdate($id, Request $request)
    {
        $word = Word::find($id);
        $checked = $request->data['checked'];
        $word->checked = $checked == 1 ? true : false;
        $result = $word->save();

        return response()->json([
            "result" => $result
        ]);
    }

    public function delete($id)
    {
        Word::destroy($id);

        return redirect()->back();
    }

    public function export(Request $request)
    {
        $export = new WordExport($request->where ? $request->where : [], $request->limit);

        return Excel::download($export, 'words.xlsx');
    }

    public function import(Request $request, Word $wordModel)
    {
        Excel::import(new WordImport(), request()->file('table_file'));

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }
}