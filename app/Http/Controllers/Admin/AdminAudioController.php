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
use ZipArchive;

class AdminAudioController extends AdminController
{

    public function index(){
        return view('admin.pages.audio_index');
    }

    public function dataList()
    {
        $files = Audio::query();

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
        //$word_name = str_replace("_", " ", $word_name);
        //$word_name = str_replace("-", " ", $word_name);

        $file_name = str_replace(" ", "_", $word_name);

        if(Storage::disk('audio')->put($file_name, File::get($file))){
            $audio_file = [
                'word_code' => $word_name,
                'file_name' => $file_name,
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

    public function zip(Request $request)
    {
        $this->zipAudioFiles();

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }

    private function zipAudioFiles()
    {
        // create a list of files that should be added to the archive.
        $files = glob(storage_path("app/public/audio/*"));

        // define the name of the archive and create a new ZipArchive instance.
        $archiveFile = storage_path("app/public/audio_archive/audio.zip");
        $archive = new ZipArchive();

        // check if the archive could be created.
        if ($archive->open($archiveFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            // loop through all the files and add them to the archive.
            foreach ($files as $file) {
                if ($archive->addFile($file, basename($file))) {
                    // do something here if addFile succeeded, otherwise this statement is unnecessary and can be ignored.
                    continue;
                } else {
                    throw new Exception("file `{$file}` could not be added to the zip file: " . $archive->getStatusString());
                }
            }

            // close the archive.
            if ($archive->close()) {
                // archive is now downloadable ...
                //return response()->download($archiveFile, basename($archiveFile))->deleteFileAfterSend(true);
            } else {
                throw new Exception("could not close zip file: " . $archive->getStatusString());
            }
        } else {
            throw new Exception("zip file could not be created: " . $archive->getStatusString());
        }
    }
}