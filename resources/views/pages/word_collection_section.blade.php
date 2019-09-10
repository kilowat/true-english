
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
        <h1 class="mdl-typography--title section-name">Название раздела</h1>
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
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="/word-collections/id/1" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/amimamls.jpg')">
                            <div class="mdl-card__title-text">Животные</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/ted.jpg')">
                            <div class="mdl-card__title-text">TED №29 Краткое название ролика</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/ted.jpg')">
                            <div class="mdl-card__title-text">TED №30 Краткое название ролика</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
            </div>
    </section>

@endsection