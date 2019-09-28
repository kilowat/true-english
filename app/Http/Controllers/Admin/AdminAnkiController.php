<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 27.09.2019
 * Time: 12:23
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\AnkiPost;
use App\Models\AnkiCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;

class AdminAnkiController extends AdminController
{
    private function saveAnkiFile($fields)
    {
        $file = Input::file('file_anki');
        $fileOriginName = $file->getClientOriginalName();
        $fileHashName = hash("md5",Carbon::now().$fileOriginName, "");
        $fileHashName.=".".$file->getClientOriginalExtension();

        if(Storage::disk('anki')->put($fileHashName, File::get($file))){
            $fields["file_name"] = $fileOriginName;
            $fields["file_hash"] = $fileHashName;
            $fields["file_size"] = $file->getSize();
        }

        return $fields;
    }

    public function index()
    {
        return view("admin.pages.anki_index");
    }

    public function add(){
        return view("admin.pages.anki_add");
    }

    public function store(AnkiPost $request)
    {
        $fields = $request->all();

        if($request->file_anki){
            $fields = $this->saveAnkiFile($fields);
        }

        $created = AnkiCard::create($fields);

        if(!empty($request->tags) && $created){
            $arr_tags = explode(",", $request->tags);
            $created->retag($arr_tags);
        }

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function dataList()
    {
        $anki = AnkiCard::query()->orderBy("id", "desc");

        return Datatables::of($anki)
            ->addColumn('action', function ($anki) {
                $btn_str =  '<a href="'.route('admin.anki.edit', $anki->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.="<br>";
                $btn_str.='<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.anki.delete', $anki->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->removeColumn('created_at')
            ->editColumn('picture', function ($anki) {
                return '<img src="'.$anki->previewPicture.'" width="100">';
            })
            ->editColumn('active', function($anki){
                if($anki->active){
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

    public function edit($id)
    {
        $anki = AnkiCard::with('tagged')->find($id);

        return view('admin.pages.anki_edit', compact('anki'));
    }

    public function update($id, AnkiPost $request)
    {
        $fields = $request->all();

        if($request->file_anki){
            $fields = $this->saveAnkiFile($fields);
        }

        $updated = AnkiCard::find($id)->update($fields);

        if(!empty($request->tags) && $updated){
            $arr_tags = explode(",", $request->tags);
            AnkiCard::find($id)->retag($arr_tags);
        }

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }

    public function delete($id)
    {
        AnkiCard::destroy($id);

        return redirect()->back();
    }
}