@extends('adminlte::page')

@section('title', 'Изменить колоду'.$anki->name)

@section('content_header')
    <h1>Изменить колоду {{ $anki->name }}</h1>
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
                    <form role="form" method="post" action="{{ route('admin.anki.update', $anki->id) }}" enctype="multipart/form-data">
                    @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" value="{{ $anki->name }}" placeholder="Enter ...">
                        </div>

                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" class="form-control" value="{{ $anki->code }}" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Сортировка</label>
                            <input type="text" name="sort" value="{{ $anki->sort }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <div class="pic-row">
                                <img src="{{ $anki->previewPicture }}" alt="">
                            </div>
                            <label for="pictureInputFile">Картинка</label>
                            <input type="file" name="picture" id="pictureInputFile">
                        </div>
                        <div class="form-group">
                            <label for="file_anki">Файл колоды</label>
                            <input type="file" name="file_anki" id="file_anki">
                            <div class="pic-row">
                                <a href="{{ $anki->fileUrl }}" title=""{{ $anki->file_name }}>{{ $anki->file_name }}</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea name="text" class="form-control" rows="3" placeholder="Enter ...">{{ $anki->text }}</textarea>
                        </div>

                        <div class="form-group require">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $anki->title }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <label>Desctiption</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $anki->description }}</textarea>
                        </div>

                        <div class="form-group require">
                            <label>Теги</label>
                            <input type="text" name="tags" value="{{ $anki->tagsAsStr }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" {{ $anki->active ? 'checked="checked"': '' }}>
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