
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

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('grammar'))

@section('content')

    <section class="card-cmp section-list">
        <h1 class="section-header">Грамматика</h1>
            @foreach($grammars as $grammar)
                <div class="grammar-list collection">
                    <a class="grammar-item collection-item" href="{{ route('grammar.detail', [$grammar->section->code, $grammar->code]) }}" title="{{ $grammar->name }}">
                        {{ $grammar->name }}
                    </a>
                </div>
            @endforeach
        <div class="nav-pagen">

        </div>
        <div class="nav-pagen">
            {{ $grammars->links() }}
        </div>
@endsection