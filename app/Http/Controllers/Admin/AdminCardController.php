<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 14.09.2019
 * Time: 21:07
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CardPost;
use App\Models\WordCard;
use App\Models\WordSection;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class AdminCardController extends AdminController
{
    public function index(){
        return view('admin.pages.card_index');
    }

    public function dataList(){
        $cards = WordCard::with('section');

        return Datatables::of($cards)
            ->addColumn('action', function ($cards) {
                $btn_str =  '<a href="'.route('admin.word.edit', $cards->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.="<br>";
                $btn_str.=  '<a href="#del-'.$cards->id.'" class="btn btn-xs btn-danger btn-action"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
                return $btn_str;
            })
            ->editColumn('picture', function ($cards) {
                return '<img src="'.$cards->previewPicture.'" width="100">';
            })
            ->editColumn('section', function ($cards) {
                return $cards->section->name;
            })
            ->rawColumns(['action', 'picture'])
            ->make(true);
    }

    public function add(){
        $sections = WordSection::where('parent_id', '>' , 0)->get();

        return view('admin.pages.card_add', ['sections' => $sections]);
    }

    public function store(CardPost $request, WordCard $wordCard){
        $created_card= $wordCard->create($request->all());

        if($request->update_content == "on" && $request->content_text){
            $wordCard->insertWords($request->content_text, $created_card->id);
        }

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }
}