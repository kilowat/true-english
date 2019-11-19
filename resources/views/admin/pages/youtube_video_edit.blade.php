@extends('adminlte::page')

@section('title', 'Изменить элемент видео '.$element->name)

@section('content_header')
    <h1>Изменить элемент видео {{ $element->name }}</h1>
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
                    <form role="form" method="post" action="{{ route('admin.youtube-video.update', $element->id) }}" enctype="multipart/form-data">
                    @csrf
                    <!-- text input -->
                        <div class="form-group require">
                            <label>Код</label>
                            <input type="text" name="code" class="form-control" value="{{ $element->code }}" placeholder="Enter ...">
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Раздел</label>
                            <select class="form-control" name="section_id">
                                @foreach($sections as $section_item)
                                    <option value="{{ $section_item->id }}" {{ $section_item->id == $element->section_id ? 'selected="selected"' : '' }}>{{ $section_item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Статус</label>
                            <select class="form-control" name="status">
                                @foreach($element->statuses as $status_key => $status_name)
                                    <option value="{{ $status_key }}" {{ $status_key == $element->status ? 'selected="selected"' : '' }}>{{ $status_name }}</option>
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
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Youtube</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label>Английские субтитры</label>
                        <textarea class="form-control" name="en_text" rows="15" placeholder="Enter ...">{{ $element->en_text }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Русские субтитры</label>
                        <textarea class="form-control" name="ru_text" rows="15" placeholder="Enter ...">{{ $element->ru_text }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Транскрипция субтитры</label>
                        <textarea class="form-control" name="ipa_text" rows="15" placeholder="Enter ...">{{ $element->ipa_text }}</textarea>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop