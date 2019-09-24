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
                                <option value="1.0" selected="selected">1</option>
                                <option value="1.5">1.5</option>
                                <option value="2.0">2</option>
                            </select>
                        </div>
                        <div class="config-cell config-subtitle">
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
        @if($card->subtitle)
            <div id="subtitles">
                <div class="subtitle-list">
                    <?//dd($subtitles)?>
                    @foreach($card->subtitle as $key_item => $subtitle)
                        <span class="s-item youtube-marker" data-start="{{ $subtitle["start"] }}" data-end="{{ $subtitle["end"] }}">
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
    <script>

        jQuery.fn.scrollTo = function(elem) {
            var offset_line = 2;
            var offset = ($(".s-item ").first().height() * offset_line) + $(".s-item ").first().height() / 2 + 10;
            $(this).scrollTop($(this).scrollTop() - $(this).offset().top + $(elem).offset().top - offset);
            return this;
        };
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        var Update;

        $("#subtitles").scrollTop(0);

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                events: {
                    'onStateChange': onPlayerStateChange,
                    'onReady': onPlayerReady,
                }
            });
        }

        function watchScroll(){
            if($(".youtube-marker-current").length > 0){
                $("#subtitles").scrollTo($(".youtube-marker-current"));
            }
        }

        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING) {
                Update = setInterval(function() {
                    UpdateMarkers()
                    watchScroll();
                }, 50);
            } else {
                clearInterval(Update);
            }
        }

        // Sample Markers on Page
        var MarkersInit = function(markers) {
            var elements = document.querySelectorAll('.youtube-marker');
            Array.prototype.forEach.call(elements, function(el, i) {
                var time_start = el.dataset.start;
                var time_end = el.dataset.end;
                var id = el.dataset.id;;
                if (id >= 1) {
                    id = id - 1;
                } else {
                    id = 0;
                }
                marker = {};
                marker.time_start = time_start;
                marker.time_end = time_end;
                marker.dom = el;
                if (typeof(markers[id]) === 'undefined') {
                    markers[id] = [];
                }
                markers[id].push(marker);
            });
        }

        // On Ready
        var markers = [];

        document.onreadystatechange = function() {
            if (document.readyState === 'complete') {
                // Init Markers
                MarkersInit(markers);
                // Register On Click Event Handler
                var elements = document.querySelectorAll('.youtube-marker');
                Array.prototype.forEach.call(elements, function(el, i) {
                    el.onclick = function() {
                        // Get Data Attribute
                        var pos = el.dataset.start;
                        // Seek
                        player.seekTo(pos);
                        player.playVideo();
                    }
                });

            } // Document Complete
        }; // Document Ready State Change

        function UpdateMarkers() {
            var current_time = player.getCurrentTime();
            var j = 0; // NOTE: to extend for several players
            markers[j].forEach(function(marker, i) {

                if (current_time >= marker.time_start && current_time <= marker.time_end) {
                    marker.dom.classList.add("youtube-marker-current");
                } else {
                    marker.dom.classList.remove("youtube-marker-current");
                }
            });
        }

        function onPlayerReady(){
            player.setPlaybackRate (0.75);
        }

        $("#video-speed").change(function(){
            player.setPlaybackRate (parseFloat($("#video-speed").val()));
        });

        $("#show-tr").change(function(){
            var $elems = $("#subtitles .s-tr");
            if($(this).is(":checked")){
                $elems.show();
            }else{
                $elems.hide();
            }
        });

        $("#show-rev").change(function(){
            var $elems = $("#subtitles .s-ru");

            if($(this).is(":checked")){
                $elems.show();
            }else{
                $elems.hide();
            }
        });

    </script>

@endsection