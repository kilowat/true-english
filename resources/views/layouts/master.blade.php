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
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div id="app">
            <header class="header">
                <div class="top-block">
                    <div class="container">
                        <div class="left-block">
                            <div class="logo-block">
                                <a href="/" title="true-english.ru"><img src="/images/logo.png" alt="logo"></a>
                                <span class="slogan-txt"><span class="slogan-left">Учи английский по-</span> <span class="slogan-right">настоящему!</span></span>
                            </div>
                            <div class="addition-info-block">
                                <div><b>По вопросам обращайтесь:</b><br> <a href="mailto:info@true-english.ru" title="info@true-english.ru">info@true-english.ru</a></div>
                                <div class="support-row"><b>Поддержать проект:</b>
                                    <iframe src="https://money.yandex.ru/quickpay/button-widget?targets=%D0%9D%D0%B0%20%D1%80%D0%B0%D0%B7%D0%B2%D0%B8%D1%82%D0%B8%D0%B5%20%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B0&default-sum=100&button-text=11&yamoney-payment-type=on&button-size=m&button-color=orange&successURL=&quickpay=small&account=410018237147676&"
                                            width="184"
                                            height="36"
                                            frameborder="0"
                                            allowtransparency="true"
                                            scrolling="no"></iframe>
                                </div>
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
                <div class="container main-container @yield("sidebar-class")">
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
                            {!! $MainMenu->asUl() !!}
                        </div>
                        <div class="col l4 m6 s12 center-cell">
                            <div class="center-component">
                                <div id="live-widget"></div>
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
            <symbol id="ic-txt" viewBox="0 0 512 512">
                <g><path d="M257.7,384.5l65.6-57.4H51.6v114.9h271.8L257.7,384.5z M132.3,360.7h-20.1V417h-10.8v-56.3H81.5V352h50.7V360.7z    M179.7,417l-14.1-24.4L151.5,417h-12.9l20.4-32.8l-20-32.2h12.8l13.6,24l13.7-24H192l-20,32.2l20.8,32.8H179.7z M249.4,360.7   h-20.1V417h-10.8v-56.3h-19.8V352h50.7V360.7z"/><path d="M455.8,117.2h-27.9v-54h-63.1v54H337c-4,0-6.1,4.2-3.4,6.8l59.4,68.9c1.8,1.8,5,1.8,6.8,0l59.4-68.9   C461.9,121.3,459.8,117.2,455.8,117.2z" id="XMLID_10_"/><rect height="24.5" id="XMLID_9_" width="63.1" x="364.8" y="28.9"/><path d="M389.5,206v259.4c0,15.1-12.2,27.3-27.3,27.3H99.6c-15.1,0-27.3-12.2-27.3-27.3v-14.6H58.9v20   c0,19.5,15.8,35.4,35.4,35.4h273.2c19.5,0,35.4-15.8,35.4-35.4V206.1c-2,0.8-4.2,1.2-6.5,1.2C394,207.3,391.6,206.8,389.5,206z" id="XMLID_8_"/><path d="M72.3,81.1c0-15.1,12.2-27.3,27.3-27.3h252.1V50v-9.5H94.3c-19.5,0-35.4,15.8-35.4,35.4v242.5h13.4V81.1z" id="XMLID_7_"/><path d="M323.2,132H112.3v19.4h227.7l-16.1-18.6C323.6,132.6,323.4,132.3,323.2,132z" id="XMLID_6_"/><rect height="19.4" id="XMLID_5_" width="237.2" x="112.3" y="163.5"/><rect height="19.4" id="XMLID_4_" width="237.2" x="112.3" y="195"/><rect height="19.4" id="XMLID_3_" width="237.2" x="112.3" y="226.6"/><rect height="19.4" id="XMLID_2_" width="185.8" x="112.3" y="258.1"/><path d="M427.9,10.1c0-2.2-2-4.1-4.6-4.1h-54c-2.5,0-4.6,1.8-4.6,4.1v9h63.1V10.1z" id="XMLID_1_"/></g>
            </symbol>
        </svg>
        <script src="/js/app.js"></script>
        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
        <script type="text/javascript">
            /*
            VK.Widgets.Group("vk_groups", {mode: 3, no_cover: 1}, 20003922);

            $('#live-widget').append('<a href="//www.liveinternet.ru/click" '+
                'target="_blank"><img src="//counter.yadro.ru/hit?t27.1;r'+
                escape(document.referrer)+((typeof(screen)=='undefined')?'':
                    ';s'+screen.width+'*'+screen.height+'*'+(screen.colorDepth?
                    screen.colorDepth:screen.pixelDepth))+';u'+escape(document.URL)+
                ';h'+escape(document.title.substring(0,150))+';'+Math.random()+
                '" alt="" title="LiveInternet: показано количество просмотров и'+
                ' посетителей" '+
                'border="0" width="88" height="120"><\/a>');
                */
        </script>
        @yield("js")
    </body>
</html>
