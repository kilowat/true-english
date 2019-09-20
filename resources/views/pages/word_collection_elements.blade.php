
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('CollectionWordMenu') }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('word_section', $section))

@section('content')
    <section>
        <h1 class="section-header">{{ $section->name }}</h1>
    </section>

@endsection