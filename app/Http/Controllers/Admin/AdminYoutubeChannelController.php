<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\YoutubeChannelPost;
use App\Models\WordSection;
use App\Models\YoutubeChannelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminYoutubeChannelController extends AdminController
{
    public function index()
    {
        return view('admin.pages.youtube_channel_index');
    }

    public function add(){
        $sections = WordSection::where("parent_id", ">", "0")->get();

        return view("admin.pages.youtube_channel_add", compact('sections'));
    }

    public function edit($id)
    {
        $sections = WordSection::where("parent_id", ">", "0")->get();
        $element = YoutubeChannelModel::findOrFail($id);

        return view('admin.pages.youtube_channel_edit', compact('element', 'sections'));
    }

    public function store(YoutubeChannelPost $request)
    {
        $created = YoutubeChannelModel::create($request->all());

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function update($id, YoutubeChannelPost $request)
    {
        $created = YoutubeChannelModel::find($id)->update($request->all());

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }


    public function delete($id)
    {
        YoutubeChannelModel::destroy($id);

        return redirect()->back();
    }

    public function dataList()
    {
        $items = YoutubeChannelModel::query();
        return Datatables::of($items)
            ->addColumn('action', function ($items) {
                $btn_str =  '<a href="'.route('admin.youtube-channel.edit', $items->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.='<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.youtube-channel.delete', $items->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->addColumn('section', function ($items) {
                return $items->section->name;
            })
            ->removeColumn('created_at')
            ->make(true);
    }
}
