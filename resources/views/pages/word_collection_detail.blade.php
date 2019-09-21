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
        <h1>{{ $card->name }}</h1>
        <div class="card-detail">
            <div class="pic-box">
                <img src="{{ $card->previewPicture }}" alt="{{ $card->name }}">
            </div>
            <div class="card-descr">
                <div class="prop-list table">
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Слов:</span></div>
                        <div class="table-cell"><span calss="prop-value">{{ $card->words->count() }}</span></div>
                    </div>
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Скачать:</span></div>
                        <div class="table-cell"><span calss="prop-value">Excel</span></div>
                    </div>
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Дата:</span></div>
                        <div class="table-cell"><span calss="prop-value">{{ $card->shortData }}</span></div>
                    </div>
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Таблица со словами:</span></div>
                        <div class="table-cell"><span calss="prop-value"><a class="btn">Открыть</a></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-text">
            {{ $card->text }}
        </div>
    </section>
@endsection