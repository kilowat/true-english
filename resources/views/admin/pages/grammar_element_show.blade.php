@extends('adminlte::page')

@section('title', 'Грамматика элемент '.$element->name)

@section('content_header')
    <h1>Грамматика элемент {{ $element->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    {!! $element->text !!}
                </div>
            </div>
        </div>
    </div>
@stop