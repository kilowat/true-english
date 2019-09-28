<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticlePost;
use App\Models\Article;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminArticleController extends AdminController
{
    public function index()
    {
        return view("admin.pages.article_index");
    }

    public function add(){
        return view("admin.pages.article_add");
    }

    public function store(ArticlePost $request)
    {
        $created = Article::create($request->all());

        if(!empty($request->tags) && $created){
            $arr_tags = explode(",", $request->tags);
            $created->retag($arr_tags);
        }

        return redirect()->back()->with('message',  trans('messages.add_success'));
    }

    public function edit($id)
    {
        $article = Article::with('tagged')->find($id);
        return view('admin.pages.article_edit', compact('article'));
    }

    public function update($id, ArticlePost $request)
    {
        $created = Article::find($id)->update($request->all());

        if(!empty($request->tags) && $created){
            $arr_tags = explode(",", $request->tags);
            Article::find($id)->retag($arr_tags);
        }

        return redirect()->back()->with('message',  trans('messages.update_success'));
    }


    public function delete($id)
    {
        Article::destroy($id);

        return redirect()->back();
    }

    public function dataList()
    {
        $article = Article::query()->orderBy("id", "desc");;

        return Datatables::of($article)
            ->addColumn('action', function ($article) {
                $btn_str =  '<a href="'.route('admin.article.edit', $article->id).'" class="btn btn-xs btn-primary btn-action"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btn_str.="<br>";
                $btn_str.='<button onclick="if (window.confirm(\'Удалить элемент?\')) location.href=\''.route('admin.article.delete', $article->id).'\';" class="btn btn-xs btn-danger btn-action del-card"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                return $btn_str;
            })
            ->removeColumn('created_at')
            ->editColumn('picture', function ($article) {
                return '<img src="'.$article->previewPicture.'" width="100">';
            })
            ->editColumn('active', function($article){
                if($article->active){
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
}
