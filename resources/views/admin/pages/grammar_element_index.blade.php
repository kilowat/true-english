@extends('adminlte::page')

@section('title', 'Грамматика список элементов')

@section('content_header')
    <h1>Список элементов грамматики</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="button-row">
                        <a href="{{ route('admin.grammar-element.add') }}" title="Добавить" class="btn btn-primary">Добавить</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="element-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Код</th>
                            <th>Картинка</th>
                            <th>Раздел</th>
                            <th>Сортировка</th>
                            <th>Активность</th>
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
                ajax: '{!! route('admin.grammar-element.data-list') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'code', name: 'code' },
                    { data: 'picture', name: 'picture' },
                    { data: 'section', name: 'section' },
                    { data: 'sort', name: 'sort' },
                    { data: 'active', name: 'active' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    </script>
@stop
