
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('CollectionWordMenu') }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')


@section('content')
    <section class="collection-detail">
        <h1 class="mdl-typography--title section-name">Детальное название</h1>

        <div class="collection-detail__descr">
            <div class="collection-detail__pic">
                <img src="/images/ted.jpg" alt="" height="120">
            </div>
            <div class="collection-detail__property-list">
                <div class="collection-detail__property-item">
                    <span class="collection-detail__name">Кол-во слов:</span>
                    <span class="collection-detail__value">2000</span>
                </div>
                <div class="collection-detail__property-item">
                    <span class="collection-detail__name">Excel таблица:</span>
                    <span class="collection-detail__value">Icon</span>
                </div>
                <div class="collection-detail__property-item">
                    <span class="collection-detail__name">Ссылка на ролик:</span>
                    <span class="collection-detail__value">Link</span>
                </div>
                <div class="collection-detail__property-item">
                    <span class="collection-detail__name">Ссылка на на книгу:</span>
                    <span class="collection-detail__value">Link</span>
                </div>
                <div class="collection-detail__property-item">
                    <a href="" title="Посмотреть" class="button-see-video">Посмотреть</a>
                </div>
            </div>
        </div>


        <div class="component-card-list__sort-panel">
            <div class="component-card-list__sort-item">
                <label>Шрифт:</label>
                <select name="" id="">
                    <option value="14">14</option>
                    <option value="14">16</option>
                    <option value="14">18</option>
                </select>
            </div>
            <div class="component-card-list__sort-item">
                <span>Индекс:</span>
                <div class="component-card-list__sort-buttons">
                    <button>asc</button>
                    <button>desc</button>
                </div>
            </div>
            <div class="component-card-list__sort-item">
                <span>Алфавит:</span>
                <div class="component-card-list__sort-buttons">
                    <button>asc</button>
                    <button>desc</button>
                </div>
            </div>
            <div class="component-card-list__sort-item search-block">
                <div class="component-card-list__search-input">
                    <input type="text" placeholder="Перейти к слову" class="text-input">
                    <button class="search-button">
                        <svg class="ic-svg ic-search">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ic-search"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="collection-detail__list table">
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
            <div class="collection-detail__item table-row">
                <div class="collection-detail__cell table-cell word-number">
                    1
                </div>
                <div class="collection-detail__cell table-cell word-name">
                    transactions
                    <div class="collection-detail__actions">
                        <div class="row">
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-word-hunt"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-reverso"></i></a>
                            <a class="collection-detail__action-button" title="wooord-hunt"><i class="icon ico-meriam"></i></a>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-transcription">
                    |trænˈzækʃənz|
                    <div class="collection-detail__actions">
                        <div class="row">
                            <button class="collection-detail__action-button"><i class="icon ic-play"></i></button>
                            <button class="collection-detail__action-button"><i class="icon ic-youglish"></i></button>
                        </div>
                    </div>
                </div>
                <div class="collection-detail__cell table-cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
        </div>
    </section>
@endsection