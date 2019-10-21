@extends('adminlte::page')

@section('title', 'Редактировать')

@section('content_header')
    <h1>Сборники слов (Редактировать карточку)</h1>
@stop

@section('content')
    <div class="row">
        <form role="form" method="post" action="{{ route('admin.card.update', $card->id) }}" enctype="multipart/form-data">
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
                        <h3 class="box-title">Изменить картачку</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" value="{{ $card->name }}" placeholder="Enter ...">
                        </div>

                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" class="form-control" value="{{ $card->code }}" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Сортировка</label>
                            <input type="text" name="sort" value="{{ $card->sort }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <div class="pic-row">
                                <img src="{{ $card->previewPicture }}" alt="">
                            </div>
                            <label for="pictureInputFile">Картинка</label>
                            <input type="file" name="picture" id="pictureInputFile">
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea name="text" class="form-control" rows="20" placeholder="Enter ...">{{ $card->text }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Контент</label>
                            <textarea name="content_text" class="form-control" rows="5" placeholder="Enter ...">{{ $card->content_text }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="parse_content"> Парсить как текст
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="update_content"> Привязать слова
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
                                    <option value="{{ $section_item->id }}" {{ $section_item->id == $card->section_id ? 'selected="selected"' : '' }}>{{ $section_item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group require">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $card->title }}" class="form-control" placeholder="Enter ...">
                        </div>

                        <div class="form-group">
                            <label>Desctiption</label>
                            <textarea class="form-control" name="description" rows="6" placeholder="Enter ...">{{ $card->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="phrase" value="0">
                                    <input type="checkbox" name="phrase" {{ $card->phrase ? 'checked="checked"': '' }}>
                                    Режим фраз
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" {{ $card->active ? 'checked="checked"': '' }}>
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
                            <input type="text" name="youtube" value="{{ $card->youtube }}" class="form-control" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Английские субтитры</label>
                            <textarea class="form-control" name="ensubtitle" rows="15" placeholder="Enter ...">{{ $card->ensubtitle }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Русские субтитры</label>
                            <textarea class="form-control" name="rusubtitle" rows="15" placeholder="Enter ...">{{ $card->rusubtitle }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Транскрипция субтитры</label>
                            <textarea class="form-control" name="trsubtitle" rows="15" placeholder="Enter ...">{{ $card->trsubtitle }}</textarea>
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