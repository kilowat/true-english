
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
    <section class="collection-detail">
        <h1 class="mdl-typography--title section-name">Детальное название</h1>

        <div class="component-card-list__sort-panel">
            <div class="component-card-list__sort-item">
                <label>Шрифт:</label>
                <select name="" id="">
                    <option value="14">14</option>
                    <option value="14">16</option>
                    <option value="14">18</option>
                </select>
            </div>
            <div class="component-card-list__sort-item">
                <span>Индекс:</span>
                <div class="component-card-list__sort-buttons">
                    <button>asc</button>
                    <button>desc</button>
                </div>
            </div>
            <div class="component-card-list__sort-item">
                <span>Алфавит:</span>
                <div class="component-card-list__sort-buttons">
                    <button>asc</button>
                    <button>desc</button>
                </div>
            </div>
            <div class="component-card-list__sort-item search-block">
                <div class="component-card-list__search-input">
                    <input type="text" placeholder="Перейти к слову" class="text-input">
                    <button class="search-button">
                        <svg class="ic-svg ic-search">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ic-search"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="collection-detail__list table">
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
        </div>
    </section>



    <!-- 1. The widget will replace this <div> tag. -->
    <div id="widget-1"></div>


    <script>
        // 2. This code loads the widget API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://youglish.com/public/emb/widget.js";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates a widget after the API code downloads.
        var widget;
        function onYouglishAPIReady(){
            widget = new YG.Widget("widget-1", {
                width: 640,
                components: 88,
                events: {
                    'onSearchDone': onSearchDone,
                    'onVideoChange': onVideoChange,
                    'onCaptionConsumed': onCaptionConsumed
                }
            });
            // 4. process the query
            widget.search("courage","US");
        }


        var views = 0, curTrack = 0, totalTracks = 0;

        // 5. The API will call this method when the search is done
        function onSearchDone(event){
            if (event.totalResult === 0)   alert("No result found");
            else totalTracks = event.totalResult;
        }

        // 6. The API will call this method when switching to a new video.
        function onVideoChange(event){
            curTrack = event.trackNumber;
            views = 0;
        }

        // 7. The API will call this method when a caption is consumed.
        function onCaptionConsumed(event){
            return ;
            if (++views < 3)
                widget.replay();
            else
            if (curTrack < totalTracks)
                widget.next();
        }
    </script>

@endsection