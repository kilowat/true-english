@extends('adminlte::page')

@section('title', 'Изменить элемента произношение '.$element->name)

@section('content_header')
    <h1>Изменить элемент произношения {{ $element->name }}</h1>
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
                    <form role="form" method="post" action="{{ route('admin.pronons.update', $element->id) }}" enctype="multipart/form-data">
                    @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" value="{{ $element->name }}" placeholder="Enter ...">
                        </div>

                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" class="form-control" value="{{ $element->code }}" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Сортировка</label>
                            <input type="text" name="sort" value="{{ $element->sort }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea name="text" class="form-control" rows="20" placeholder="Enter ...">{{ $element->text }}</textarea>
                        </div>
                        <div class="form-group require">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $element->title }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <label>Desctiption</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $element->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" {{ $element->active ? 'checked="checked"': '' }}>
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
        </div>
    </div>
@stop