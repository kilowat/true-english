
@extends('layouts.master')

@if($page)
    @section('title', $page->title)
    @section('description', $page->description)
@endif

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
        @if($page)
            <h1 class="section-header">{{ $page->name }}</h1>
        @endif
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