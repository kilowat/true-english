<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 14.09.2019
 * Time: 22:13
 */

namespace App\Http\Controllers\Admin;


use App\Exports\WordExport;
use App\Imports\WordImport;
use App\Models\Word;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class AdminWordController extends AdminController
{
    public function index(){
        $words = Word::paginate(100);

        return view('admin.pages.word_index', ['words' => $words]);
    }

    public function dataList(){
        $words = Word::query();

        return Datatables::of($words)
            ->addColumn('action', function ($words) {
                return '<a href="#edit-'.$words->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function export(Request $request){
        $export = new WordExport($request->where ? $request->where : [], $request->limit);

        return Excel::download($export, 'words.xlsx');
    }

    public function import(Request $request, Word $wordModel){
        Excel::import(new WordImport(), request()->file('table_file'));

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }
}