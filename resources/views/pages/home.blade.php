
@extends('layouts.master')

@section('title', 'Page Title')

@section('content')

    <section class="about">
        <div class="container">
            <h1>Учим английский</h1>
            <div class="about-text">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At atque dolor, doloribus explicabo, labore nihil nulla odit omnis optio quae, quos repellendus sapiente soluta ut vero. Adipisci consequuntur deleniti officia!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias asperiores assumenda debitis doloremque, earum enim exercitationem illo itaque labore neque non officia placeat quae sint, sunt tempore, temporibus! Error, ipsa.</p>
            </div>
        </div>
    </section>
    <section class="component-top component-card-list">
        <h2 class="component-top__header mdl-typography--title">Новые сборники слов</h2>
        <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/amimamls.jpg')">
                            <div class="mdl-card__title-text">Животные</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/ted.jpg')">
                            <div class="mdl-card__title-text">TED №29 Краткое название ролика</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/ted.jpg')">
                            <div class="mdl-card__title-text">TED №30 Краткое название ролика</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
            </div>
    </section>

    <section class="component-top component-card-list">
        <h2 class="component-top__header mdl-typography--title">Новые материалы</h2>
        <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/amimamls.jpg')">
                            <div class="mdl-card__title-text">Статья 1</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/ted.jpg')">
                            <div class="mdl-card__title-text">Название статьи 2</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                    <a class="mdl-card-square mdl-shadow--2dp" href="#" title="#">
                        <div class="mdl-card__title mdl-card--expand" style="background-image:url('/images/ted.jpg')">
                            <div class="mdl-card__title-text">Название статьи 3</div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__added-date">Дата: <b>11.12.2020</b></div>
                            <div class="mdl-card__word-count">Слов: <b>4000</b></div>
                        </div>
                    </a>
                </div>
            </div>
    </section>


@endsection