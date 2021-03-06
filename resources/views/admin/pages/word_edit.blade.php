@extends('adminlte::page')

@section('title', 'Редактировать слово #'.$word->id." ".$word->name )

@section('content_header')
    <h1>#{{ $word->id }} {{ $word->name }}</h1>
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
                    <h3 class="box-title">Новый раздел</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="{{ route('admin.word.update', $word->id) }}">
                    @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" value="{{ $word->name }}" placeholder="Enter ...">
                        </div>

                        <div class="form-group require">
                            <label>Транскрипция</label>
                            <input type="text" name="transcription" value="{{ $word->transcription }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Перевод</label>
                            <textarea name="translate"class="form-control" placeholder="Enter ...">{{ $word->translate }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="pictureInputFile">Аудио</label>
                            <audio controls=""><source src="{{ $word->audio->url }}" type="audio/mpeg"></audio>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="checked" value="0">
                                    <input type="checkbox" name="checked" {{ $word->checked ? 'checked="checked"': '' }}>
                                    Проверено
                                </label>
                            </div>
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