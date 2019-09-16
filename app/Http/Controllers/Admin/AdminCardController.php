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

class AdminCardController extends AdminController
{
    public function index(){
        $cards = WordCard::with('section')->get();

        return view('admin.pages.card_index', ['cards' => $cards]);
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