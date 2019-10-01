@extends('adminlte::page')

@section('title', 'Статья '.$article->name)

@section('content_header')
    <h1>Статья {{ $article->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    {!! $article->text !!}}
                </div>
            </div>
        </div>
    </div>
@stop