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

    public function export(){
        return Excel::download(new WordExport(), 'words.xlsx');
    }

    public function import(Request $request, Word $wordModel){
       // dd($request);
        //$arrayExcelFile = Excel::toArray(new WordImport(), $request->file('table_file'), 'local', \Maatwebsite\Excel\Excel::XLSX);
        //dd($arrayExcelFile[0]);
        //DB::table($wordModel->getTable())->insertOrIgnore($array);
        Excel::import(new WordImport(), request()->file('table_file'));
        return redirect()->back()->with('message',  trans('messages.add_success'));
    }
}