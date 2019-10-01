@extends('adminlte::page')

@section('title', 'Изменить страницу')

@section('content_header')
    <h1>Изменить страницу</h1>
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
                    <form role="form" method="post" action="{{ route('admin.page.update', $page->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" value="{{ $page->code }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group require">
                            <label>Название</label>
                            <input type="text" name="name" value="{{ $page->name }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <label>Текст</label>
                            <textarea class="form-control" name="text" rows="3" placeholder="Enter ...">{{ $page->text }}</textarea>
                        </div>

                        <div class="form-group require">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $page->title }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <label>Desctiption</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $page->description }}</textarea>
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