@extends('layouts.master')

@section('title', $card->title)

@section ('description', $card->description)

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('CollectionWordMenu') }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('breadcrumbs', Breadcrumbs::render('card', $section, $card))

@section('sidebar-class', 'with-sidebar')


@section('content')
    <section>
        <h1 class="section-header">{{ $card->name }}</h1>
        <div class="card-detail">
            <div class="pic-box">
                @if($card->youtube)
                    <iframe width="300"
                            height="220"
                            src="https://www.youtube.com/embed/{{ $card->youtube }}"
                            frameborder="0"
                            allow="accelerometer;
                            autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                @else
                    <img src="{{ $card->previewPicture }}" alt="{{ $card->name }}">
                @endif
            </div>
            <div class="card-descr">
                <div class="prop-list table">
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Слов:</span></div>
                        <div class="table-cell"><span calss="prop-value">{{ $card->words->count() }}</span></div>
                    </div>
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Скачать:</span></div>
                        <div class="table-cell">
                            <span calss="prop-value">
                                <a href="{{ $card->excel }}" title="Таблица"><svg class="ic-excel"><use xlink:href="#ic-excel" x="0" y="0"></use></svg> Скачать</a>
                            </span>
                        </div>
                    </div>
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Дата:</span></div>
                        <div class="table-cell"><span calss="prop-value">{{ $card->shortData }}</span></div>
                    </div>
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Таблица:</span></div>
                        <div class="table-cell"><span calss="prop-value"><a class="btn" href="{{ route('word-collection.table', $card->id) }}" title="Таблица" target="_blank">Открыть</a></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-text">
            {{ $card->text }}
        </div>
    </section>
@endsection