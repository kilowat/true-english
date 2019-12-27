
@extends('layouts.master')

@if(!empty($page))
    @section('title', $page->title)
@section('description', $page->description)
@endif

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('dict_index'))

@section('content')

    <section class="card-cmp section-list">
        @if(!empty($page))
            <h1 class="section-header">{{ $page->name }}</h1>
            {!! $page->text !!}
        @endif
        <div class="cmp">
            <dict-component url="dict/list"> </dict-component>
        </div>
    </section>
@endsection