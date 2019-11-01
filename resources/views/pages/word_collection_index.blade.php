
@extends('layouts.master')

@if($page)
    @section('title', $page->title)
    @section('description', $page->description)
@endif

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

@section('breadcrumbs', Breadcrumbs::render('word_collections'))

@section('content')
    <section class="card-cmp section-list">
        @if($page)
            <h1 class="section-header">{{ $page->name }}</h1>
            {!! $page->text !!}
        @endif
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