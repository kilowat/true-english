
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
        <h1 class="mdl-typography--title section-name">Сборники Сборников</h1>
        <div class="section-text">
            <p>Alias blanditiis cum distinctio dolor dolorum iste libero maiores mollitia nisi, nobis numquam qui,
                quidem ratione tenetur ut. Culpa cumque, distinctio eaque illum in perferendis quia ratione recusandae
                sapiente ut! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus animi consequatur distinctio error illo odit placeat sint. A dolor ipsum molestiae odio perspiciatis praesentium quasi quo reiciendis voluptas. Ex, harum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aut dolor dolorem dolorum ea ex hic, ipsa iste natus nemo neque nobis nostrum officia omnis optio possimus quidem tempore unde.</p>
        </div>

        <div class="mdl-grid">
            @foreach($sections as $section)
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="{{ $section->link }}" title="{{ $section->name }}">
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
    </section>

@endsection