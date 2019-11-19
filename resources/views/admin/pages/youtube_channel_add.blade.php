@extends('adminlte::page')

@section('title', 'Создать канал для парсинга')

@section('content_header')
    <h1>Создать канал для парсинга</h1>
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
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="{{ route("admin.youtube-channel.store") }}" enctype="multipart/form-data">
                    @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Enter ...">
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Раздел</label>
                            <select class="form-control" name="section_id">
                                @foreach($sections as $section_item)
                                    <option value="{{ $section_item->id }}" {{ old("section_id") == $section_item->id ? "selected='selected'" : ''}}>{{ $section_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop