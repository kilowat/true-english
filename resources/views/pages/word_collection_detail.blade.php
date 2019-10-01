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
                    <iframe id="{{ $card->youtube }}" src="https://www.youtube.com/embed/{{ $card->youtube }}?enablejsapi=1" width="560" height="315" allowfullscreen="allowfullscreen"></iframe></p>
                    <div class="video-config">
                        <div class="config-row">
                            <div class="config-cell config-subtitle">
                                <label>
                                    <input type="checkbox" data-class="s-en" id="show-en" checked="checked"/>
                                    <span class="en-label">Англ-слова</span>
                                </label>
                                <label>
                                    <input type="checkbox" data-class="s-tr" id="show-tr" checked="checked"/>
                                    <span class="tr-label">Тран-ция</span>
                                </label>
                                <label>
                                    <input type="checkbox" data-class="s-ru" id="show-rev" checked="checked" />
                                    <span class="rev-label">Перевод</span>
                                </label>
                            </div>
                        </div>
                        <div class="config-row">
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
                            <div class="config-cell delay-player">
                                <label>Пауза</label>
                                <select name="video-delay" class="browser-default" id="video-delay">
                                    <option value="0" selected="selected">0</option>
                                    <option value="-1">На фразе</option>
                                    <option value="1000">1 сек</option>
                                    <option value="2000">2 сек</option>
                                    <option value="3000">3 сек</option>
                                    <option value="5000">5 сек</option>
                                    <option value="8000">8 сек</option>
                                    <option value="10000">10 сек</option>
                                </select>
                            </div>
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
            {!! $card->text  !!}
        </div>
        @if($card->subtitles)
            <div id="subtitles">
                <div id="videoTranscript{{ $card->youtube }}" class="mmocVideoTranscript subtitle-list" data-route="{{ route("api.subtitle", $card->id) }}" ></div>
            </div>
        @endif
    </section>
@endsection

@section('js')
    <script>
        //Everything is ready, load the youtube iframe_api
        $.getScript("https://www.youtube.com/iframe_api");
    </script>

@endsection