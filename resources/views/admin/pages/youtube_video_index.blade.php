@extends('adminlte::page')

@section('title', 'Список youtube video')

@section('content_header')
    <h1>Список youtube video</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="button-row">
                        <a href="{{ route('admin.youtube-video.add') }}" title="Добавить" class="btn btn-primary">Добавить</a>
                        <a href="javascript:void(0)" onclick="if (window.confirm('Отчистить историю?')) location.href='{{ route('admin.youtube-video.delete-all') }}';" title="Очистить" class="btn btn-danger">Очистить</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="element-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Код</th>
                            <th>Название</th>
                            <th>Раздел</th>
                            <th>Статус</th>
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
                ajax: '{!! route('admin.youtube-video.data-list') !!}',
                columns: [
                    { data: 'code', name: 'code' },
                    { data: 'title', name: 'title' },
                    { data: 'section', name: 'section' },
                    { data: 'status', name: 'status' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    </script>
@stop
