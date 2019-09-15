@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Генерация слов</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-3">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Выгрузка слова</h3>
                    <div class="button-row">
                        <input type="checkbox"><label for="">Проверненные</label>
                        <input type="checkbox"><label for="">Не проверенные</label>
                        <input type="checkbox" checked="checked"><label for="">Пустые</label>
                    </div>
                    <div class="button-row">
                        <button class="btn btn-primary">Выгрузить слова</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Загрузка слова</h3>
                    <div class="button-row">
                        <input type="file">
                    </div>
                    <div class="button-row">
                        <button class="btn btn-primary">Загрузить слова</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="progress-status">
                Обработано слов: 0
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
