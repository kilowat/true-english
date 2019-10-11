<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PrononsPost;
use App\Models\Pronons;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminPrononsController extends AdminController
{
    public function index()
    {
        return view("admin.pages.pronons_index");
    }

    public function add()
    {
        return view("admin.pages.pronons_add");
    }

    public function store(PrononsPost $request)
    {
        $created = Pronons::create($request->all());

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function show($id)
    {
        $element = Pronons::findOrFail($id);

        return view('admin.pages.pronons_show', compact('element'));
    }

    public function edit($id)
    {
        $element = Pronons::findOrFail($id);

        return view('admin.pages.pronons_edit', compact('element'));
    }

    public function update($id, PrononsPost $request)
    {
        $created = Pronons::find($id)->update($request->all());

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }


    public function delete($id)
    {
        Pronons::destroy($id);

        return redirect()->back();
    }

    public function dataList()
    {
        $pronons = Pronons::query();

        return Datatables::of($pronons)
            ->addColumn('action', function ($pronons) {
                $btn_str =  '<a href="'.route('admin.pronons.edit', $pronons->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.=  '<a href="'.route('admin.pronons.show', $pronons->id).'" class="btn btn-xs btn-success btn-action"><i class="glyphicon glyphicon-eye-open"></i> Show</a>';
                $btn_str.='<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.grammar-element.delete', $pronons->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->removeColumn('created_at')
            ->editColumn('active', function($pronons){
                if($pronons->active){
                    $label = "success";
                    $active = "Активно";
                }else{
                    $label = "warning";
                    $active = "Не активно";
                }

                return '<span class="label label-'.$label.'">'.$active.'</span>';
            })
            ->rawColumns(['action', 'picture','active'])
            ->make(true);
    }
}
