
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
        <h1 class="mdl-typography--title section-name">{{ $current_section->name }}</h1>
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
            @foreach($sections as $section)
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="{{ $current_section->code."/".$section->code }}" title="{{ $section->name }}">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('{{ $section->previewPicture }}')">
                            <div class="mdl-card__title-text">{{ $section->name }}</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__word-count">Сборников: <b>4000</b></div>
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