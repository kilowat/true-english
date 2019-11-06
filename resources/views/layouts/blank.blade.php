<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield("description")" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>
<body>
<div id="app">
    <div id="slide-out" class="sidenav">
        <i class="close-drawer"></i>
        {!! $MainMenu->asUl() !!}
        <div class="dop-section">
            @yield("drower_dop_section")
        </div>
    </div>
    <main>
        <div class="container main-container">
            <div class="content">
                @yield("content")
            </div>
        </div>
    </main>
</div>
<script src="/js/app.js"></script>
@yield("js")
</body>
</html>
