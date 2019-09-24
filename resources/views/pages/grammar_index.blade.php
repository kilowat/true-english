
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        <div class="collection-menu">

        </div>
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('grammar'))

@section('content')

    <section class="card-cmp section-list">
        <h1 class="section-header">Грамматика</h1>
    </section>

@endsection