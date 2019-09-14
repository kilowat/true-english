@extends('adminlte::page')

@section('title', 'Сборники слов')

@section('content_header')
    <h1>Сборники слов (Карточки)</h1>
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
                    <table id="section-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Тр-ция</th>
                            <th>Перевод</th>
                            <th>Дата создания</th>
                            <th>Дата изменения</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($words as $word)
                            <tr>
                                <td>{{ $word->id }}</td>
                                <td>{{ $word->name }}</td>
                                <td>{{ $word->transcription }}</td>
                                <td>{{ $word->translate }}</td>
                                <td>{{ $word->created_at }}</td>
                                <td>{{ $word->updated_at }}</td>
                                <td>
                                    <a href="" title="">Изменить</a><br>
                                    <a href="" title="">Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Тр-ция</th>
                            <th>Перевод</th>
                            <th>Дата создания</th>
                            <th>Дата изменения</th>
                            <th>Управление</th>
                        </tr>
                        </tfoot>
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
        $(function () {
            $('#section-table').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })
    </script>
@stop
