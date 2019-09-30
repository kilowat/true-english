<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>true-english.ru | {{ $card->name }}</title>
    <meta name="description" content="{{ $card->description }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="word-sort-panel">
        <div class="table-wrapp">
            <div class="action-block">
                <div class="action-cell sort-cell back-cell">
                    <a href="{{ route('word-collection.detail', $card->uri) }}" title="Вернуться"><i class="material-icons dp48">navigate_before</i></a>
                </div>
            </div>
            {{ Widget::run('WordSort') }}
            <div class="search-block">
                <input type="text" id="autoComplete" placeholder="Поиск">
            </div>
        </div>
    </div>
    <div class="table-page">
        <h1 class="section-header">{{ $card->name }}</h1>
        <div class="table" id="results">
            <div class='theader'>
                <div class='table_header'>№</div>
                <div class='table_header'>Частота</div>
                <div class='table_header'>Слово</div>
                <div class='table_header'>Транс-ия</div>
                <div class='table_header'>Перевод</div>
                <div class='table_header'>Аудио</div>
                <div class='table_header'>Видео</div>
                <div class='table_header'>Ссылки</div>
            </div>
            <?php $count = 1; //$count = ($words->currentPage() * $words->perPage()) - $words->perPage() + 1; //dd($word_list)?>
            @foreach($words as $word)
                <div class='table_row' id="word-{{ $word->name }}">
                    <div class='table_small'>
                        <div class='table_cell'>№:</div>
                        <div class='table_cell'>{{ $count }}</div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>Частота:</div>
                        <div class='table_cell cell-freq'>{{ $word->freq }}</div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>Слово:</div>
                        <div class='table_cell'>{{ $word->name }}</div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>Транскрипция:</div>
                        <div class='table_cell'>{{ $word->transcription }}</div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>Перевод:</div>
                        <div class='table_cell'>{{ $word->translate }}</div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>Аудио:</div>
                        <div class='table_cell'>
                            @if($word->audio)
                                <audio controls><source src="{{ $word->audio->url }}" type="{{ $word->audio->mime }}"></audio>
                            @else
                                Не найден
                            @endif
                        </div>
                    </div>
                    <div class="table_small">
                        <div class="table_cell">Видео</div>
                        <div class="table_cell">
                            <a href="javascript:void(0)" @click="openYouglishBox('{{ $word->name }}')"><i class="icon ic-youglish"></i></a>
                        </div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>Ссылки:</div>
                        <div class='table_cell link-cell'>
                            <a href="{{ $word->contextReversoLink }}" target="_blank" title="reverso"><i class="icon ic-reverso"></i></a>
                            <a href="{{ $word->meriamlLink }}" target="_blank"><i class="icon ic-meriam"></i></a>
                            <a href="{{ $word->wordHuntLink }}" target="_blank"><i class="icon ic-word-hunt"></i></a>
                            <a href="{{ $word->yandexLink }}" target="_blank"><i class="icon ic-yandex"></i></a>
                        </div>
                    </div>
                </div>
                <?php $count++;?>
            @endforeach
        </div>
    </div>
</div>

<script src="/js/app.js"></script>
@yield("js")
<script>
    // autoComplete.js on type event emitter
    document.querySelector("#autoComplete").addEventListener("autoComplete", function (event) {
        console.log(event.detail);
        console.log(autoCompletejs);
    });

    document.querySelector("#autoComplete").addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            event.preventDefault();
            var selection = this.value;

            var $word = $("#word-"+selection).addClass("selected");
            $('html, body').animate({
                scrollTop: $word.offset().top - 100
            }, 500);
        }
    });

    // The autoComplete.js Engine instance creator
    var autoCompletejs = new autoComplete({
        data: {
            src: function () {
                // Loading placeholder text
                document.querySelector("#autoComplete").setAttribute("placeholder", "Loading...");
                // Fetch External Data Source
                //const source = await fetch("./db/generic.json");
                //const data = await source.json();
                // Returns Fetched data

                var res = JSON.parse('<?php echo json_encode($words) ?>');

                return res;
            },
            key: ["name"],
        },
        sort: function (a, b) {
            if (a.match < b.match) {
                return -1;
            }
            if (a.match > b.match) {
                return 1;
            }
            return 0;
        },
        query: {
            manipulate: function (query) {
                return query;
            },
        },
        trigger: {
            condition: function (query) {
                $("#results .selected").removeClass('selected');
                return query;
            },
        },
        placeHolder: "Поиск",
        selector: "#autoComplete",
        threshold: 0,
        debounce: 0,
        searchEngine: "strict",
        highlight: true,
        maxResults: 10,
        resultsList: {
            render: true,
            container: function (source) {
                source.setAttribute("id", "autoComplete_results_list");
            },
            element: "ul",
            destination: document.querySelector("#autoComplete"),
            position: "afterend",
        },
        resultItem: {
            content: function (data, source) {
                source.innerHTML = data.match;
            },
            element: "li",
        },
        noResults: function () {
            var result = document.createElement("li");
            result.setAttribute("class", "no_result");
            result.setAttribute("tabindex", "1");
            result.innerHTML = "No Results";
            document.querySelector("#autoComplete_results_list").appendChild(result);
        },
        onSelection: function (feedback) {
            var selection = feedback.selection.value.name;
            // Clear Input
            document.querySelector("#autoComplete").value = "";
            // Change placeholder with the selected value
            document.querySelector("#autoComplete").setAttribute("placeholder", selection);
            // Concole log autoComplete data feedback
            //location.href="#word-"+selection;
            var $word = $("#word-"+selection).addClass("selected");
            $('html, body').animate({
                scrollTop: $word.offset().top - 100
            }, 500);
        },
    });

    // On page load add class to input field
    window.addEventListener("load", function () {
        document.querySelector("#autoComplete").classList.add("out");
        // document.querySelector("#autoComplete_results_list").style.display = "none";
    });

</script>
</body>
</html>
