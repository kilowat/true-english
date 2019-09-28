<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 13.09.2019
 * Time: 11:12
 */

namespace App\Http\Controllers\Admin;



use App\Models\Audio;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminAudioController extends AdminController
{

    public function index(){
        return view('admin.pages.audio_index');
    }

    public function dataList()
    {
        $files = Audio::query()->orderBy("id", "desc");

        return Datatables::of($files)
            ->addColumn('action', function ($files) {
                $btn_str = '<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.audio.delete', $files->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->editColumn('file_name', function($files) {
                return $files->file_name."<br><audio controls><source src='/storage/audio/".$files->file_name."' type='".$files->mime."'></audio>";
            })
            ->rawColumns(['file_name', 'action'])
            ->make(true);
    }

    public function add(){
        return view('admin.pages.audio_add');
    }

    public function uploadFile(Request $request)
    {
        $file = Input::file('file');
        $file_name_origin = $file->getClientOriginalName();
        $word_name = explode('.', $file_name_origin)[0];
        $word_name = str_replace(" ", "_", $word_name);

        if(Storage::disk('audio')->put($file_name_origin, File::get($file))){
            $audio_file = [
                'word_code' => $word_name,
                'file_name' => $file_name_origin,
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),

            ];

            $audio_item = Audio::where('word_code', '=', $word_name)->first();

            if($audio_item){
                 Audio::find($audio_item->id)->update($audio_file );
                $file_id = $audio_item->id;
            }else{
                $file_id = Audio::create($audio_file)->id;
            }

            return response()->json([
                'success' => true,
                'id' => $file_id
            ]);
        }else{
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function delete($id)
    {
        $file = Audio::where('id', '=', $id)->first();

        if($file){
            Storage::disk('audio')->delete($file->file_name);
            Audio::destroy($id);
        }

        return redirect()->back();
    }
}