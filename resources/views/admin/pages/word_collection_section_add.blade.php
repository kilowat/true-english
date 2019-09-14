@extends('adminlte::page')

@section('title', 'Сборники слов')

@section('content_header')
    <h1>Сборники слов (Добавить раздел)</h1>
@stop

@section('content')
    <div class="box">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box-header with-border">
            <h3 class="box-title">Новый раздел</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" action="{{ route('admin.word-collection-sections.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- text input -->
                <div class="form-group require">
                    <label>Название</label>
                    <input type="text" class="form-control" placeholder="Enter ...">
                </div>

                <div class="form-group require">
                    <label>Код</label>
                    <input type="text" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group">
                    <label for="pictureInputFile">Картинка</label>
                    <input type="file" id="pictureInputFile">
                </div>
                <div class="form-group">
                    <label>Текст</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Select</label>
                    <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                    </select>
                </div>

                <div class="form-group require">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Enter ...">
                </div>

                <div class="form-group">
                    <label>Desctiption</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Активность
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
@stop