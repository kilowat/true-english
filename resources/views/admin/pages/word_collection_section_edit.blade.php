@extends('adminlte::page')

@section('title', 'Сборники слов')

@section('content_header')
    <h1>(Карточки слов) Изменить раздел</h1>
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
                    <form role="form" method="post" action="{{ route('admin.word-collection-sections.update', $section->id) }}" enctype="multipart/form-data">
                    @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" value="{{ $section->name }}" placeholder="Enter ...">
                        </div>

                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" class="form-control" value="{{ $section->code }}" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Сортировка</label>
                            <input type="text" name="sort" value="{{ $section->sort }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <div class="pic-row">
                                <img src="{{ $section->previewPicture }}" alt="">
                            </div>
                            <label for="pictureInputFile">Картинка</label>
                            <input type="file" name="picture" id="pictureInputFile">
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea name="text" class="form-control" rows="3" placeholder="Enter ...">{{ $section->text }}</textarea>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Родительский раздел</label>
                            <select class="form-control" name="parent_id">
                                <option value="">--Корневой--</option>
                                @foreach($parent_sections as $section_item)
                                    @if($section_item->id !== $section->id)
                                        <option value="{{ $section_item->id }}" {{ $section_item->id == $section->parent_id ? 'selected="selected"' : ''}}>{{ $section_item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group require">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $section->title }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <label>Desctiption</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $section->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="active" {{ $section->active ? 'checked="checked"': '' }}>
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