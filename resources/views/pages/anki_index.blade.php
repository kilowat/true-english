
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
        <div class="row">
            @foreach($cards as $card)
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-image">
                            <img src="/storage/{{ $card->picture }}">
                            <span class="card-title">{{ $card->name }}</span>
                        </div>
                        <div class="card-content">
                            {{ $card->text }}
                        </div>
                        <div class="card-action">
                            <a href="{{ $card->fileUrl }}" title="{{ $card->file_name }}" class="btn">Скачать</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="nav-pagen">
            {{ $cards->links() }}
        </div>
    </section>
@endsection