@extends('layouts.master')

@section('title', $card->title)

@section ('description', $card->description)

@section('sidebar')
    <aside class="sidebar">
        <div class="collection-menu">
            {!! $CollectionMenu->asUl() !!}
        </div>
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
                    <iframe id="player" src="https://www.youtube.com/embed/{{ $card->youtube }}?enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="video-config">
                        <div class="config-cell speed-player">
                            <label>Скорость</label>
                            <select name="speed" class="browser-default" id="video-speed">
                                <option value="0.25">0.25</option>
                                <option value="0.5">0.5</option>
                                <option value="0.75">0.75</option>
                                <option value="1.0" selected="selected">1</option>
                                <option value="1.25">1.25</option>
                                <option value="1.5">1.5</option>
                                <option value="2.0">2</option>
                            </select>
                        </div>
                        <div class="config-cell config-subtitle">
                            <label>
                                <input type="checkbox" id="show-en" checked="checked"/>
                                <span class="en-label">Англ-слова</span>
                            </label>
                            <label>
                                <input type="checkbox" id="show-tr" checked="checked"/>
                                <span class="tr-label">Тран-ция</span>
                            </label>
                            <label>
                                <input type="checkbox" id="show-rev" checked="checked" />
                                <span class="rev-label">Перевод</span>
                            </label>
                        </div>
                    </div>

                @else
                    <img src="{{ $card->previewPicture }}" alt="{{ $card->name }}">
                @endif
            </div>
            <div class="card-descr">
                <div class="prop-list table">
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Уникальных слов:</span></div>
                        <div class="table-cell"><span calss="prop-value">{{ $card->words->count() }}</span></div>
                    </div>
                    @if($card->excel)
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Excel файл со словами:</span></div>
                        <div class="table-cell">
                            <span calss="prop-value">
                                <a href="{{ $card->excel }}" title="Таблица"><svg class="ic-excel"><use xlink:href="#ic-excel" x="0" y="0"></use></svg> Скачать</a>
                            </span>
                        </div>
                    </div>
                    @endif
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Дата публикации:</span></div>
                        <div class="table-cell"><span calss="prop-value">{{ $card->shortData }}</span></div>
                    </div>
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">Все слова из материала:</span></div>
                        <div class="table-cell"><span calss="prop-value"><a class="btn" href="{{ route('word-collection.table', $card->id) }}" title="Таблица" target="_blank">Открыть</a></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-text">
            {{ $card->text }}
        </div>
        @if($card->subtitles)
            <div id="subtitles">
                <div class="subtitle-list">
                    @foreach($card->subtitles as $key_item => $subtitle)
                        <span class="s-item youtube-marker" data-start="{{ $subtitle["start"] }}" data-end="{{ $subtitle["end"] }}">
                            <span class="time-line">{{ $subtitle["line"]["time"] }}</span>
                            <span class="s-en">{{ $subtitle["line"]["en"] }}</span>
                            <span class="s-tr">{{ $subtitle["line"]["tr"] }}</span>
                            <span class="s-ru">{{ $subtitle["line"]["ru"] }}</span>
                        </span>
                    @endforeach
                </div>
            </div>
            @endif
    </section>
@endsection

@section('js')
    <script src="/js/youtube_player.js">
    </script>

@endsection