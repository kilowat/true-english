@extends('adminlte::page')

@section('title', 'Сборники слов')

@section('content_header')
    <h1>Сборники слов (Добавить карточку)</h1>
@stop

@section('content')
    <div class="row">
        <form role="form" method="post" action="{{ route('admin.card.store') }}" enctype="multipart/form-data">
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
                        @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" value="{{ old("name") }}" placeholder="Enter ...">
                        </div>

                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" class="form-control" value="{{ old("code") }}" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Сортировка</label>
                            <input type="text" name="sort" value="{{ old("sort") ?  old("sort") : 100}}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label for="pictureInputFile">Картинка</label>
                            <input type="file" name="picture" id="pictureInputFile">
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea name="text" class="form-control" rows="6" placeholder="Enter ...">{{ old("text") }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Контент</label>
                            <textarea name="content_text" class="form-control" rows="3" placeholder="Enter ...">{{ old("content_text") }}</textarea>
                        </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" {{ old("parse_content") ? "checked='checked'" : ''}} name="parse_content"> Парсить слова
                                    </label>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" {{ old("update_content") ? "checked='checked'" : ''}} name="update_content"> Привязать слова
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="create_excel"> Создать excel таблицу
                                </label>
                            </div>
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

                        <div class="form-group require">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old("title") }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <label>Desctiption</label>
                            <textarea class="form-control" name="description" rows="6" placeholder="Enter ...">{{ old("description") }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" {{ old("phrase") ? "checked='checked'" : ''}} name="phrase">
                                    Режим фраз
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" {{ old("active") ? "checked='checked'" : ''}} name="active">
                                    Активность
                                </label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Youtube</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Код видео</label>
                            <input type="text" name="youtube" value="{{ old("youtube") }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Английские субтитры</label>
                            <textarea class="form-control" name="ensubtitle" rows="15" placeholder="Enter ...">{{ old("ensubtitle") }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Русские субтитры</label>
                            <textarea class="form-control" name="rusubtitle" rows="15" placeholder="Enter ...">{{ old("rusubtitle") }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Транскрипция субтитры</label>
                            <textarea class="form-control" name="trsubtitle" rows="15" placeholder="Enter ...">{{ old("trsubtitle") }}</textarea>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </form>
    </div>
@stop