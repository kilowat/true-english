@extends('adminlte::page')

@section('title', 'Сборники слов')

@section('content_header')
    <h1>Список слов</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список слов</h3>
                    <div class="button-row">
                        <a href="{{ route('admin.card.add') }}" title="Добавить" class="btn btn-primary">Добавить</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="word-table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Тр-ция</th>
                            <th>Перевод</th>
                            <th>Аудио</th>
                            <th>Проверено</th>
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
            $('#word-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.word.data-list') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'transcription', name: 'transcription' },
                    { data: 'translate', name: 'translate' },
                    { data: 'audio', name: 'audio', orderable: false, searchable: false},
                    { data: 'checked', name: 'checked' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@stop
