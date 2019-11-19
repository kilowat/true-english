@extends('adminlte::page')

@section('title', 'Список youtube каналов')

@section('content_header')
    <h1>Список youtube каналов</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="button-row">
                        <a href="{{ route('admin.youtube-channel.add') }}" title="Добавить" class="btn btn-primary">Добавить</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="element-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Код</th>
                            <th>Раздел</th>
                            <th>Статус</th>
                            <th>Кол-во видео</th>
                            <th>Дата изменения</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop
@section('js')
    <script>
        $(function() {
            $('#element-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.youtube-channel.data-list') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'code', name: 'code' },
                    { data: 'section', name: 'section' },
                    { data: 'status', name: 'status' },
                    { data: 'video_count', name: 'video_count' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    </script>
@stop
