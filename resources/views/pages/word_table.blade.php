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
        </div>
    </div>
    <div class="table-page">
        <h1 class="section-header">{{ $card->name }}</h1>
        <div class="table" id="results">
            <div class='theader'>
                <div class='table_header'>№</div>
                <div class='table_header'>Индекс</div>
                <div class='table_header'>Слово</div>
                <div class='table_header'>Транскрипция</div>
                <div class='table_header'>Перевод</div>
                <div class='table_header'>Аудио</div>
                <div class='table_header'>Ссылки</div>
            </div>
            <?php $count = ($words->currentPage() * $words->perPage()) - $words->perPage() + 1; //dd($word_list)?>
            @foreach($words as $word)
                <div class='table_row'>
                    <div class='table_small'>
                        <div class='table_cell'>№:</div>
                        <div class='table_cell'>{{ $count }}</div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>Индекс:</div>
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
                    <div class='table_small'>
                        <div class='table_cell'>Ссылки:</div>
                        <div class='table_cell'>
                            <i class="icon ic-youglish"></i>
                            <i class="icon ic-reverso"></i>
                            <i class="icon ic-meriam"></i>
                            <i class="icon ic-word-hunt"></i>
                        </div>
                    </div>
                </div>
                <?php $count++;?>
            @endforeach
        </div>
        <div class="nav-pagen">
            {{ $words->appends(['column' => $request->column, 'order' => $request->order])->links() }}
        </div>
    </div>
</div>

<script src="/js/app.js"></script>
</body>
</html>
