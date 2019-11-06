
@extends('layouts.blank')


@section('title', "Заголовок")
@section('description', "Описание")


@section('content')
    <phrase-training word="{{ $word }}"></phrase-training>
@endsection