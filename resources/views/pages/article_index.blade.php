
@extends('layouts.master')
@if($page)
    @section('title', $page->title)
    @section('description', $page->description)
@endif

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('Tags', ['model' => "App\Models\Article", 'route' => 'article.index.tag', 'current_tag' => $tag]) }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('drower_dop_section')
    {{ Widget::run('Tags', ['model' => "App\Models\Article", 'route' => 'article.index.tag', 'current_tag' => $tag]) }}
@stop

@section('breadcrumbs', Breadcrumbs::render('article_index'))

@section('content')

    <section class="card-cmp article">
        @if($page)
            <h1 class="section-header">{{ $page->name }}</h1>
        @endif
        <div class="row">
            @foreach($articles as $article)
                <div class="col s12 m6 l4">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ $article->previewPicture }}" alt="{{ $article->name }}">
                            <span class="card-title">{{ $article->name }}</span>
                        </div>
                        <div class="card-content">
                            {!! $article->previewText !!}
                        </div>
                        <div class="card-action">
                            <a href="{{ route("article.detail", $article->code) }}" class="btn">Подробнее</a>
                            <span class="data-created">{{ $article->shortDate }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="nav-pagen">
            {{ $articles->links() }}
        </div>
    </section>
@endsection