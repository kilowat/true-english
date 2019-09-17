@extends('adminlte::page')

@section('title', 'Сборники слов')

@section('content_header')
    <h1>Аудио файлы</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список аудио файлов</h3>
                    <div class="button-row">
                        <a href="{{ route('admin.audio.add') }}" title="Добавить" class="btn btn-primary">Добавить</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="audio-table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Слово</th>
                            <th>Имя файла</th>
                            <th>Тип</th>
                            <th>Размер</th>
                            <th>Дата создания</th>
                            <th>Дата изменения</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function() {
            $('#audio-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.audio.data-list') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'word_code', name: 'word_code' },
                    { data: 'file_name', name: 'file_name' },
                    { data: 'mime', name: 'mime' },
                    { data: 'size', name: 'size' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@stop
