
@extends('layouts.master')

@section('title', $current_section->title)
@section('description', $current_section->description)

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('CollectionWordMenu') }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('word_section', $current_section))

@section('content')

    <section class="card-cmp section-list">
        <h1 class="section-header">{{ $current_section->name }}</h1>
        <div class="row">
            @foreach($sections as $section)
                <div class="col s12 m6 l3">
                    <a class="card" href="{{ $section->link }}" title="">
                        <div class="card-image">
                            <img src="{{ $section->previewPicture }}">
                            <span class="card-title">{{ $section->name }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="nav-pagen">
            {{ $sections->links() }}
        </div>
    </section>

@endsection