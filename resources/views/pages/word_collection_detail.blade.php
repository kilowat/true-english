
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
        <div class="collection-detail__list">
            <div class="collection-detail__item">
                <div class="collection-detail__cell word-number">
                    1
                </div>
                <div class="collection-detail__cell word-name">
                    transactions
                </div>
                <div class="collection-detail__cell word-transcription">
                    |trænˈzækʃənz|
                </div>
                <div class="collection-detail__cell word-translate">
                    операций, сделок, сделки, операциях, сделках, сделкам, операциями, операциям, транзакций, сделками, транзакциях, финансовые операции, транзакциями
                </div>
            </div>
        </div>
    </section>

@endsection