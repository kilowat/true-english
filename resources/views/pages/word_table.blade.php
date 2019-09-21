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
    <div class="table-page">
        <table>
            <caption>Statement Summary</caption>
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Индекс</th>
                <th scope="col">Слово</th>
                <th scope="col">Транскрипция</th>
                <th scope="col">Перевод</th>
                <th scope="col">Аудио</th>
                <th scope="col">Ссылки</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = ($words->currentPage() * $words->perPage()) - $words->perPage() + 1; //dd($word_list)?>
            @foreach($words as $word)
                <tr>
                    <td data-label="Account">{{ $count }}</td>
                    <td data-label="Due Date">{{ $word->freq }}</td>
                    <td data-label="Amount">{{ $word->name }}</td>
                    <td data-label="Period">{{ $word->transcription }}</td>
                    <td data-label="Period">{{ $word->translate }}</td>
                    <td data-label="Period">audio</td>
                    <td data-label="Period">#####</td>
                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="/js/app.js"></script>
</body>
</html>
