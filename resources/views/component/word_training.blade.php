
@extends('layouts.blank')


@section('title', "Фразы со словом ".$word)
@section('description', "Карточки с фразами в которых встречается слово ".$word)


@section('content')
    <div class="back-row"><a href="javascript:void(0)" onclick="_app.goBack()" title=""><i class="material-icons dp48">navigate_before</i> Вернуться назад</a></div>
    <phrase-training word="{{ $word }}"></phrase-training>
@endsection