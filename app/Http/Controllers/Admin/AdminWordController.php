<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 14.09.2019
 * Time: 22:13
 */

namespace App\Http\Controllers\Admin;


use App\Models\Word;
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
}