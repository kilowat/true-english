
@extends('layouts.master')

@section('title', $element->title)
@section('description', $element->description)

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection


@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('prononciation_detail', $element))

@section('content')
    <section>
        <h1 class="section-header">{{ $element->name }}</h1>
        <div class="article-detail">
            {!! $element->text !!}
        </div>
    </section>
@endsection