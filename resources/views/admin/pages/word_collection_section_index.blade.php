@extends('adminlte::page')

@section('title', 'Сборники слов')

@section('content_header')
    <h1>Сборники слов (разделы)</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список разделов</h3>
                    <div class="button-row">
                        <a href="{{ route('admin.word-collection-sections.addSection') }}" title="Добавить" class="btn btn-primary">Добавить</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Картинка</th>
                            <th>Подразделы</th>
                            <th>Сортировка</th>
                            <th>Активность</th>
                            <th>Дата создания</th>
                            <th>Дата изменения</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <td>{{ $section->id }}</td>
                            <td>{{ str_repeat("- ", $section->depth) }}{{ $section->name }}</td>
                            <td>Win 95+</td>
                            <td>
                                <span>Кол-во: {{ count($section->children) }}</span>
                            </td>
                            <td>{{ $section->sort }}</td>
                            <td>{{ $section->active ? "Активен" : "Не активет" }}</td>
                            <td>{{ $section->created_at }}</td>
                            <td>{{ $section->updated_at }}</td>
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
                            <th>Подразделы</th>
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
