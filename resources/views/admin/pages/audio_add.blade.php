@extends('adminlte::page')

@section('title', 'Загрузить аудио файлы')

@section('content_header')
<h1>Форма загрузка ауидо файлов</h1>
@stop

@section('content')
<div class="row">
    <upload-audio></upload-audio>
</div>
@stop