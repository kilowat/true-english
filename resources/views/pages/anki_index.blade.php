
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('Tags', ['model' => "App\Models\AnkiCard", 'route' => 'anki.index.tag', 'current_tag' => $tag]) }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')

@section('breadcrumbs', Breadcrumbs::render('anki'))

@section('content')

    <section class="card-cmp section-list">
        <h1 class="section-header">Колоды Anki</h1>
        @foreach($cards as $card)
            <div>
                {{ $card->name }}
            </div>
        @endforeach
@endsection