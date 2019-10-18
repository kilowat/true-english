<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>True-English - {{ $card->name }}</title>
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
                    <a href="{{ route('word-collection.detail', $card->uri)}}" title="Вернуться"><i class="material-icons dp48">navigate_before</i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="table-page table-component">
        <h1 class="section-header">{{ $card->name }}</h1>
        <word-table-component card-id="{{ $card->id }}" sort-field="freq" sort-order="desc"></word-table-component>
    </div>
</div>

<script src="/js/app.js"></script>
@yield("js")
</body>
</html>
