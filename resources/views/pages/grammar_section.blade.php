
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        <div class="collection-menu">
            {!! $grammarMenu->asUl() !!}
        </div>
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('drower_dop_section')
    {!! $grammarMenu->asUl() !!}
@stop

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('grammar_section', $section))

@section('content')

    <section class="card-cmp section-list">
        <h1 class="section-header">{{ $section->name }}</h1>
        @foreach($grammars as $grammar)
            <div class="grammar-list collection">
                <a class="grammar-item collection-item" href="{{ route("grammar.detail", [$section->code, $grammar->code]) }}" title="{{ $grammar->name }}">
                    {{ $grammar->name }}
                </a>
            </div>
        @endforeach
        <div class="nav-pagen">
            {{ $grammars->links() }}
        </div>
@endsection