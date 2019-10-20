@extends('layouts.master')

@section('title', $grammar->title)

@section ('description', $grammar->description)

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

@section('breadcrumbs', Breadcrumbs::render('grammar_detail', $section, $grammar))

@section('sidebar-class', 'with-sidebar')


@section('content')
    <section>
        <h1 class="section-header">{{ $grammar->name }}</h1>
        <div class="content-detail">
            {!! $grammar->text !!}
        </div>
    </section>
@stop