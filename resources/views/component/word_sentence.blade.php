
@extends('layouts.blank')


@section('title', "Фразы со словом ".$word)
@section('description', "Карточки с предложениями в которых встречается слово ".$word)


@section('content')
    <div class="back-row"><a href="javascript:void(0)" onclick="_app.goBack()" title=""><i class="material-icons dp48">navigate_before</i>Назад</a></div>
    <sentence-training word="{{ $word }}"></sentence-training>
@endsection
