@extends('layouts.master')

@section('title', $grammar->title)

@section ('description', $grammar->description)

@section('sidebar')
    <aside class="sidebar">
        <div class="collection-menu">
            {!! $grammarMenu->asUl() !!}
        </div>
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('breadcrumbs', Breadcrumbs::render('grammar_detail', $section, $grammar))

@section('sidebar-class', 'with-sidebar')


@section('content')
    <section>
        <h1 class="section-header">{{ $grammar->name }}</h1>
        <div class="content-detail">
            {!! $grammar->text !!}
        </div>
    </section>

    <!-- 1. The widget will replace this <div> tag. -->
    <div id="widget-1"></div>



@endsection
@section("js")
    <script>
        function openYouglishBox(word){
            // 2. This code loads the widget API code asynchronously.
            var tag = document.createElement('script');

            tag.src = "https://youglish.com/public/emb/widget.js";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // 3. This function creates a widget after the API code downloads.
            window.widget;

            window.onYouglishAPIReady = function(){
                widget = new YG.Widget("widget-1", {
                    width: 640,
                    components:8 + 16 + 64, //search box & caption
                    events: {
                        'onSearchDone': onSearchDone,
                        'onVideoChange': onVideoChange,
                        'onCaptionConsumed': onCaptionConsumed
                    }
                });
                // 4. process the query
                widget.search(word,"US");
            }


            var views = 0, curTrack = 0, totalTracks = 0;

            // 5. The API will call this method when the search is done
            window.onSearchDone = function(event){
                if (event.totalResult === 0)   alert("No result found");
                else totalTracks = event.totalResult;
            }

            // 6. The API will call this method when switching to a new video.
            window.onVideoChange = function(event){
                curTrack = event.trackNumber;
                views = 0;
            }

            // 7. The API will call this method when a caption is consumed.
             window.onCaptionConsumed = function(event){
                if (curTrack < totalTracks)
                    widget.next();
            }
        }
        runYouglish("run");
    </script>
@endsection