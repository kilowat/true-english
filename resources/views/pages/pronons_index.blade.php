
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

@section('breadcrumbs', Breadcrumbs::render('prononciation_index'))

@section('content')

    <section class="card-cmp section-list">
        @if($page)
            <h1 class="section-header">{{ $page->name }}</h1>
            {!! $page->text !!}
        @endif
        @foreach($elements as $element)
            <div class="pronons-list collection">
                <a class="pronons-item collection-item" href="{{ route("prononciation.detail", [$element->code]) }}" title="{{ $element->name }}">
                    {{ $element->name }}
                </a>
            </div>
        @endforeach
        <div class="nav-pagen">
            {{ $elements->links() }}
        </div>
@endsection