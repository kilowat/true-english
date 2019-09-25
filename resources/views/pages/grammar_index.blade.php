
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('grammar'))

@section('content')

    <section class="card-cmp section-list">
        <h1 class="section-header">Грамматика</h1>
        <div class="row">
            @foreach($sections as $section)
                <div class="col s12 m6 l3">
                    <a class="card" href="" title="">
                        {{ $section->name }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="nav-pagen">

        </div>

@endsection