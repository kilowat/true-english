
@extends('layouts.master')

@if($page)
    @section('title', $page->title)
@section('description', $page->description)
@endif

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('misc_index'))

@section('content')

    <section class="card-cmp section-list">
        @if($page)
            <h1 class="section-header">{{ $page->name }}</h1>
        @endif
    </section>
@endsection