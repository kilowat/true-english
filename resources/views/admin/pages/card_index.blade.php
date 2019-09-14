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
                    <h3 class="box-title">Список карточек</h3>
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
                            <th>Картинка</th>
                            <th>Раздел</th>
                            <th>Сортировка</th>
                            <th>Активность</th>
                            <th>Дата создания</th>
                            <th>Дата изменения</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cards as $card)
                            <tr>
                                <td>{{ $card->id }}</td>
                                <td>{{ $card->name }}</td>
                                <td><img src="{{ $card->previewPicture }}" style="max-width: 80px" alt=""></td>
                                <td>{{ $card->section->name }}</td>
                                <td>{{ $card->sort }}</td>
                                <td>{{ $card->active ? "Активен" : "Не активет" }}</td>
                                <td>{{ $card->created_at }}</td>
                                <td>{{ $card->updated_at }}</td>
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
                            <th>Картинка</th>
                            <th>Раздел</th>
                            <th>Сортировка</th>
                            <th>Активность</th>
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
