
@extends('layouts.master')

@section('title', $section->title)
@section('description', $section->description)

@section('sidebar')
    <aside class="sidebar">
        <div class="collection-menu">
            {!! $CollectionMenu->asUl() !!}
        </div>
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('drower_dop_section')
    {!! $CollectionMenu->asUl() !!}
@stop

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('word_section', $section))

@section('content')
    <section class="section-list">
        <h1 class="section-header">{{ $section->name }}</h1>
        <div class="row">
            @foreach($elements as $element)
                <div class="col s12 m6 l3">
                    <a class="card" href="{{ $element->link}}" title="{{ $element->name }}">
                        <div class="card-image">
                            <img src="{{ $element->previewPicture }}">
                            <span class="card-title">{{ $element->name }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="nav-pagen">
            {{ $elements->links() }}
        </div>
    </section>

@endsection