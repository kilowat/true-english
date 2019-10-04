<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PagePost;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use ZipArchive;

class AdminPageController extends AdminController
{
    public function main()
    {
        return view("admin.pages.index");
    }

    public function index()
    {
        return view("admin.pages.page_index");
    }

    public function add(){
        return view("admin.pages.page_add");
    }

    public function store(PagePost $request)
    {
        $created = Page::create($request->all());

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.page_edit', compact('page'));
    }

    public function update($id, PagePost $request)
    {
        $created = Page::find($id)->update($request->all());

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }


    public function delete($id)
    {
        Page::destroy($id);

        return redirect()->back();
    }

    public function dataList()
    {
        $page = Page::query()->orderBy("id", "desc");;

        return Datatables::of($page)
            ->addColumn('action', function ($page) {
                $btn_str =  '<a href="'.route('admin.page.edit', $page->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.="<br>";
                $btn_str.='<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.article.delete', $page->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->removeColumn('created_at', 'text', 'title', 'description')
            ->rawColumns(['action'])
            ->make(true);
    }
}
