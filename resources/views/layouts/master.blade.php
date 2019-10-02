<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>true-english.ru | @yield('title')</title>
        <meta name="description" content="@yield("description")" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700&display=swap&subset=cyrillic" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <header class="header">
                <div class="top-block">
                    <div class="container">
                        <div class="left-block">
                            <div class="logo-block">
                                <a href="/" title="true-english.ru"><img src="/images/logo.png" alt="logo"></a>
                            </div>
                        </div>
                        <!--
                        <div class="user-block">
                            <div class="user-line">
                                <a href="#" title="">Авторизоваться</a>
                            </div>
                        </div>
                        -->
                    </div>
                </div>

                <nav class="nav-block main-menu" role="navigation">
                    <a href="javascript:void(0)" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <div class="container">
                        {!! $MainMenu->asUl() !!}
                    </div>
                </nav>
            </header>
            <!--drower-->
            <div id="slide-out" class="sidenav">
                {!! $MainMenu->asUl() !!}
                <div class="dop-section">
                    @yield("drower_dop_section")
                </div>
            </div>
            <!--end drower-->
            @yield('breadcrumbs')
            <main>
                <div class="container main-container @yield("sidebar-class")" id="app">
                    @yield("sidebar")
                    <div class="content">
                        @yield("content")
                    </div>
                </div>
            </main>
            <footer class="page-footer">
                <div class="container">
                    <div class="row">
                        <div class="col l4 m6 s12 menu-block">
                            <h5 class="white-text">Меню</h5>
                            {!! $MainMenu->asUl() !!}
                        </div>
                        <div class="col l4 m6 s12 center-cell">
                            <div class="center-component">

                            </div>
                        </div>
                        <div class="col l4 m6 s12 vk-block">
                            <!-- VK Widget -->
                            <div id="vk_groups">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        &copy; <?php echo date('Y'); ?> true-english.ru
                    </div>
                </div>
            </footer>
        </div>
        <svg style="display:none">
            <symbol id="ic-dict" viewBox="0 0 50 50">
                <path d="M 12 2 C 8.691406 2 6 4.691406 6 8 L 6 42.417969 C 6 45.496094 8.691406 48 12 48 L 44 48 L 44 46 L 12 46 C 9.832031 46 8 44.359375 8 42.417969 C 8 40.503906 9.757813 39 12 39 L 44 39 L 44 2 Z M 19.285156 13 L 21.714844 13 L 27 28.421875 L 27 29 L 25 29 L 25 28.753906 L 24.058594 26 L 16.941406 26 L 16 28.753906 L 16 29 L 14 29 L 14 28.421875 Z M 20.5 15.625 L 17.628906 24 L 23.371094 24 Z M 32 17 C 33.792969 17 35 18.40625 35 20.5 L 35 26 C 35 26.550781 35.449219 27 36 27 L 36 29 C 35.230469 29 34.53125 28.699219 34 28.21875 C 33.46875 28.699219 32.769531 29 32 29 L 31 29 C 29.347656 29 28 27.652344 28 26 L 28 24 C 28 22.347656 29.347656 21 31 21 L 32 21 C 32.351563 21 32.6875 21.070313 33 21.183594 L 33 20.5 C 33 19.816406 32.824219 19 32 19 C 31.507813 19 31 19.117188 31 20 L 29 20 C 29 18.207031 30.207031 17 32 17 Z M 31 23 C 30.449219 23 30 23.449219 30 24 L 30 26 C 30 26.550781 30.449219 27 31 27 L 32 27 C 32.550781 27 33 26.550781 33 26 L 33 24 C 33 23.449219 32.550781 23 32 23 Z"/>
            </symbol>
            <symbol id="ic-excel" viewBox="0 0 48 48">
                <path fill="#388E3C" d="M40 45L8 45 8 3 30 3 40 13z"/><path fill="#E8F5E9" d="M38.5 14L29 14 29 4.5z"/><path fill="#FFF" d="M23.739,26.457l2.092-4.254h3.524l-3.577,6.346L29.452,35h-3.56l-2.153-4.333L21.586,35h-3.551l3.665-6.451l-3.568-6.346h3.516L23.739,26.457z"/>
            </symbol>
        </svg>
        <script src="/js/app.js"></script>
        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
        <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 3, no_cover: 1}, 20003922);
        </script>
        @yield("js")
    </body>
</html>
