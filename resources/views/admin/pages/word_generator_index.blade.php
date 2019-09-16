@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Генерация слов</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Выгрузка слова</h3>
                    <form action="{{ route('admin.word.export') }}" method="post">
                        @csrf
                        <div class="button-row">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="where[checked]" value="0"> Не проверенные
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="where[translate]" value=""> Нет перевода
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="where[transcription]" value=""> Нет транскрипции
                                </label>
                            </div>
                        </div>
                        <div class="button-row">
                            <button class="btn btn-primary" type="submit" name="export_submit" value="Y">Выгрузить слова</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Загрузка слова</h3>
                    <form action="{{ route('admin.word.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="button-row">
                            <input type="file" name="table_file">
                        </div>
                        <div class="button-row">
                            <button class="btn btn-primary" type="submit" name="import_submit" value="Y">Загрузить слова</button>
                        </div>
                    </form>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                </div>
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
