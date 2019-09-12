
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('CollectionWordMenu') }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')


@section('content')
    <section class="component-card-list">
        <h1 class="mdl-typography--title section-name">{{ $section->name }}</h1>
        <div class="component-card-list__sort-panel">
            <div class="component-card-list__sort-item">
                <span>Название:</span>
                <div class="component-card-list__sort-buttons">
                    <button>asc</button>
                    <button>desc</button>
                </div>
            </div>
            <div class="component-card-list__sort-item">
                <span>Дата:</span>
                <div class="component-card-list__sort-buttons">
                    <button>asc</button>
                    <button>desc</button>
                </div>
            </div>
            <div class="component-card-list__sort-item">
                <span>Кол-во слов:</span>
                <div class="component-card-list__sort-buttons">
                    <button>asc</button>
                    <button>desc</button>
                </div>
            </div>
        </div>
        <div class="mdl-grid">
            @foreach($elements as $item)
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="{{ \App\Models\WordCard::makeUrlToDetail($parent_section_code, $section->code, $item->code)}}" title="">
                        <div class="mdl-card__title mdl-card--expand" >
                            <div class="mdl-card__title-text">{{ $item->name }}</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="nav-pagen">

        </div>
    </section>

@endsection