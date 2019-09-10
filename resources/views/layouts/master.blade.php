<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>true-english - @yield('title')</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body class="mdl-app mdl-base">
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header" id="app">
            <header class="mdl-layout__header mdl-layout__header--scroll">
                <div class="bg-color">
                    <div class="mdl-layout--large-screen-only mdl-layout__header-row header-block container">

                    </div>
                    <div class="mdl-layout--large-screen-only navigation-row">
                        {{ Widget::run('MainMenu') }}
                    </div>
                </div>
            </header>
            <main>
                <div class="container @yield("sidebar-class")">
                    @yield("sidebar")
                    <div class="content">
                        @yield("content")
                    </div>
                </div>
            </main>
            <footer class="mdl-mega-footer">
                <div class="mdl-mega-footer--middle-section container">
                    <div class="mdl-mega-footer--drop-down-section">
                        <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
                        <h1 class="mdl-mega-footer--heading">Навигация по сайту</h1>
                        <ul class="mdl-mega-footer--link-list">
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Updates</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mdl-mega-footer--bottom-section container">
                    <div class="mdl-logo">
                        true-english.ru - 2019 г.
                    </div>
                </div>
            </footer>
        </div>
        <script src="/js/app.js"></script>
        <svg style="display:none">
            <symbol viewBox="0 0 24 24" id="ic-search">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/><path d="M0 0h24v24H0z" fill="none"/>
        </symbol>
        </svg>
    </body>
</html>
</html>
