<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>true-english - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700&display=swap&subset=cyrillic" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <header class="header">
                <div class="top-block">

                </div>

                <nav class="nav-block" role="navigation">
                    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <div class="container">
                        {{ Widget::run('MainMenu') }}
                    </div>
                </nav>
            </header>
            <!--drower-->
            <ul id="slide-out" class="sidenav">
                <li><div class="user-view">
                        <div class="background">
                            <img src="images/office.jpg">
                        </div>
                        <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
                        <a href="#name"><span class="white-text name">John Doe</span></a>
                        <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
                    </div></li>
                <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
                <li><a href="#!">Second Link</a></li>
                <li><div class="divider"></div></li>
                <li><a class="subheader">Subheader</a></li>
                <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
            </ul>
            <!--end drower-->
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
                        <div class="col l6 s12">
                            <h5 class="white-text">Company Bio</h5>
                            <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


                        </div>
                        <div class="col l3 s12">
                            <h5 class="white-text">Settings</h5>
                            <ul>
                                <li><a class="white-text" href="#!">Link 1</a></li>
                                <li><a class="white-text" href="#!">Link 2</a></li>
                                <li><a class="white-text" href="#!">Link 3</a></li>
                                <li><a class="white-text" href="#!">Link 4</a></li>
                            </ul>
                        </div>
                        <div class="col l3 s12">
                            <h5 class="white-text">Connect</h5>
                            <ul>
                                <li><a class="white-text" href="#!">Link 1</a></li>
                                <li><a class="white-text" href="#!">Link 2</a></li>
                                <li><a class="white-text" href="#!">Link 3</a></li>
                                <li><a class="white-text" href="#!">Link 4</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
                    </div>
                </div>
            </footer>
        </div>
        <svg style="display:none">
            <symbol id="ic-dict" viewBox="0 0 50 50">
                <path d="M 12 2 C 8.691406 2 6 4.691406 6 8 L 6 42.417969 C 6 45.496094 8.691406 48 12 48 L 44 48 L 44 46 L 12 46 C 9.832031 46 8 44.359375 8 42.417969 C 8 40.503906 9.757813 39 12 39 L 44 39 L 44 2 Z M 19.285156 13 L 21.714844 13 L 27 28.421875 L 27 29 L 25 29 L 25 28.753906 L 24.058594 26 L 16.941406 26 L 16 28.753906 L 16 29 L 14 29 L 14 28.421875 Z M 20.5 15.625 L 17.628906 24 L 23.371094 24 Z M 32 17 C 33.792969 17 35 18.40625 35 20.5 L 35 26 C 35 26.550781 35.449219 27 36 27 L 36 29 C 35.230469 29 34.53125 28.699219 34 28.21875 C 33.46875 28.699219 32.769531 29 32 29 L 31 29 C 29.347656 29 28 27.652344 28 26 L 28 24 C 28 22.347656 29.347656 21 31 21 L 32 21 C 32.351563 21 32.6875 21.070313 33 21.183594 L 33 20.5 C 33 19.816406 32.824219 19 32 19 C 31.507813 19 31 19.117188 31 20 L 29 20 C 29 18.207031 30.207031 17 32 17 Z M 31 23 C 30.449219 23 30 23.449219 30 24 L 30 26 C 30 26.550781 30.449219 27 31 27 L 32 27 C 32.550781 27 33 26.550781 33 26 L 33 24 C 33 23.449219 32.550781 23 32 23 Z"/>
            </symbol>
        </svg>
        <script src="/js/app.js"></script>
    </body>
</html>
