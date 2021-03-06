
@extends('layouts.master')

@section('title', $article->title)
@section('description', $article->description)

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('Tags', ['model' => "App\Models\Article", 'route' => 'article.index.tag']) }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('drower_dop_section')
    {{ Widget::run('Tags', ['model' => "App\Models\Article", 'route' => 'article.index.tag']) }}
@stop

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('article_detail', $article))

@section('content')
    <section>
        <h1 class="section-header">{{$article->name}}</h1>
        <div class="article-detail">
         {!! $article->text !!}
        </div>
    </section>
@endsection