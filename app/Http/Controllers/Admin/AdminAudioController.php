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
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminAudioController extends AdminController
{

    public function index(){
        return view('admin.pages.audio_index');
    }

    public function dataList(){
        $files = Audio::query();

        return Datatables::of($files)
            ->addColumn('action', function ($words) {
                $btn_str = '<a href="#del-'.$words->id.'" class="btn btn-xs btn-danger btn-action"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
                return $btn_str;
            })
            ->make(true);
    }

    public function add(){
        return view('admin.pages.audio_add');
    }

    public function uploadFile(Request $request){
        $file = Input::file('file');
        $filename = $file->getClientOriginalName();

        if(Storage::disk('audio')->put($filename, File::get($file))){
            $audio_file = [
                'word_code' => '',
                'file_name' => '',
                'mime' => '',
                'size' => '',

            ];
            $file = Audio::create($audio_file);

            return response()->json([
                'success' => true,
                'id' => $file->id
            ]);
        }else{
            return response()->json([
                'success' => false
            ], 500);
        }
    }
}