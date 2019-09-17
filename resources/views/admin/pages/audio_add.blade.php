@extends('adminlte::page')

@section('title', 'Загрузить аудио файлы')

@section('content_header')
<h1>Форма загрузка ауидо файлов</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-6">
        <div class="box">
            <div class="box-header with-border">
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h3 class="box-title">Загрузить аудио файлы</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" method="post" action="">
                    @csrf
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@stop