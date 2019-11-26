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

@section('drower_dop_section')
    {!! $CollectionMenu->asUl() !!}
@stop

@section('breadcrumbs', Breadcrumbs::render('card', $section, $card))

@section('sidebar-class', 'with-sidebar')


@section('content')
    <section>
        <h1 class="section-header">{{ $card->name }}</h1>
        <div class="card-text">
            {!! $card->text  !!}
        </div>
        <div class="card-detail">
            <div class="pic-box">
                @if($card->youtube)
                    <iframe id="{{ $card->youtube }}"
                            src="https://www.youtube.com/embed/{{ $card->youtube }}?enablejsapi=1"
                            width="100%" height="315"
                            frameborder="0"
                            allow="autoplay"
                            allowfullscreen="allowfullscreen"></iframe>
                    <div class="config-toggle-row">
                        <a href="javascript:void(0)" title="Скрыть/Показать" id="settings-toggle">Скрыть/Показать настройки</a>
                    </div>
                    <div class="video-config">
                        <div class="config-row">
                            <div class="config-cell config-subtitle">
                                <label>
                                    <input type="checkbox" data-class="s-en" id="show-en" checked="checked"/>
                                    <span class="en-label">Англ-слова</span>
                                </label>
                                <label>
                                    <input type="checkbox" data-class="s-tr" id="show-tr"/>
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
                                    <option value="0" selected="selected">Нет</option>
                                    <option value="-1">На фразе</option>
                                </select>
                            </div>
                            <div class="config-cell font-size">
                                <label for="font-size-s">Размер шрифта</label>
                                <select name="font-size" class="browser-default" id="font-size-s">
                                    <option value="14" selected="selected">1</option>
                                    <option value="18">1.5</option>
                                    <option value="22">2</option>
                                </select>
                            </div>
                            @if($card->phrase)
                                <div class="config-cell">
                                    <label for="phrase-mode">
                                        <input type="checkbox"id="phrase-mode" />
                                        <span>Режим фраз</span>
                                        <span class="tip-text">(Видео будет перематываться между фразами)</span>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="player-handler">
                        <button class="player-btn btn" id="replay-btn"><i class="material-icons small dp48">replay</i></button>
                        <button class="player-btn btn" id="play-btn"><i class="material-icons small dp48">play_circle_outline</i></button>
                        <button class="player-btn btn" id="stop-btn"><i class="material-icons small dp48">stop</i></button>
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
                                <a href="{{ route('word-collection.excel-download', $card->id) }}" title="Таблица"><svg class="ic-excel"><use xlink:href="#ic-excel" x="0" y="0"></use></svg> Скачать</a>
                            </span>
                            </div>
                        </div>
                    @endif
                    <div class="prop-item table-row">
                        <div class="table-cell"><span class="prop-name">TXT файл со словами:</span></div>
                        <div class="table-cell">
                            <span calss="prop-value">
                                <a href="{{ route('api.text-words', $card->id) }}" title="файл"><svg class="ic-svg ic-txt"><use xlink:href="#ic-txt" x="0" y="0"></use></svg> Скачать</a>
                            </span>
                        </div>
                    </div>
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