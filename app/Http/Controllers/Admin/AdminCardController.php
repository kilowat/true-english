<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 14.09.2019
 * Time: 21:07
 */

namespace App\Http\Controllers\Admin;


use App\Exports\CardExport;
use App\Exports\WordExport;
use App\Http\Requests\CardPost;
use App\Models\WordCard;
use App\Models\WordSection;
use App\Services\Subtitles\SubtitleCreator;
use Benlipp\SrtParser\Parser;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Masih\YoutubeDownloader\YoutubeDownloader;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;


class AdminCardController extends AdminController
{
    private function createExcel(WordCard $wordCard, $id)
    {
        $words = [];
        $wordQuery = $wordCard->find($id)->words;

        foreach($wordQuery as $item){
            $words[] = $item->word;
        }

        $file_name = "word_table_".$id.".xlsx";

        if(Excel::store(new CardExport($words), $file_name, 'excel')){
            $wordCard->find($id)->update(["excel_file" => $file_name]);
        }
    }

    public function index()
    {
        return view('admin.pages.card_index');
    }

    public function dataList()
    {
        $cards = WordCard::with('section')->orderBy("id", "desc");

        return Datatables::of($cards)
            ->addColumn('action', function ($cards) {
                $btn_str =  '<a href="'.route('admin.card.edit', $cards->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.="<br>";
                $btn_str.=  '<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.card.delete', $cards->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->editColumn('picture', function ($cards) {
                return '<img src="'.$cards->previewPicture.'" width="100">';
            })
            ->editColumn('section', function ($cards) {
                return $cards->section->name;
            })
            ->editColumn('active', function($cards){
                if($cards->active){
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

    public function add(){
        $sections = WordSection::where('parent_id', '>' , 0)->get();

        return view('admin.pages.card_add', ['sections' => $sections]);
    }

    public function edit($id){
        $card = WordCard::where('id', '=', $id)->first();

        $sections = WordSection::where('parent_id', '>' , 0)->get();

        return view('admin.pages.card_edit', compact('card', 'sections'));
    }

    public function update($id, CardPost $request, WordCard $wordCard)
    {
        $fields = $request->all();

        if(!empty($request->ensubtitle)){
            try {
                $creator = new SubtitleCreator($request->ensubtitle, $request->rusubtitle, $request->trsubtitle);
                $fields["subtitles"] = $creator->merge();
            }catch (\Exception $e){
                return redirect()->back()->withErrors([
                    "Subtitles format corrupted",
                    $e->getMessage()
                ]);
            }
        }

        $wordCard->find($id)->update($fields);

        if($request->update_content == "on" && $request->content_text){
            $wordCard->insertWords($request->content_text, $id);
        }

        if($request->create_excel == "on")
        {
            $this->createExcel($wordCard, $id);
        }

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }

    public function store(CardPost $request, WordCard $wordCard){
        $fields = $request->all();

        if(!empty($request->ensubtitle))
        {
            $creator = new SubtitleCreator($request->ensubtitle, $request->rusubtitle, $request->trsubtitle);
            $fields["subtitles"] = $creator->merge();
        }

        $created_card = $wordCard->create($fields);

        if($request->update_content == "on" && $request->content_text){
            $wordCard->insertWords($request->content_text, $created_card->id);
        }

        if($request->create_excel == "on"){
            $this->createExcel($wordCard, $created_card->id);
        }

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function delete($id)
    {
        WordCard::destroy($id);
        return redirect()->back();
    }
}