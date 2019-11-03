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
                    <div class="button-row">
                        <a href="{{ route('admin.word.add') }}" title="Добавить" class="btn btn-primary">Добавить</a>
                    </div>
                    <h3 class="box-title">Список слов</h3>
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
                            <th>Изменено</th>
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
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

        function setWordChecked(id, e)
        {
            let $label = $(e).prev();
            let worn_class = 'label-warning';
            let success_class = 'label-success';
            let unchecked_str = 'Не проверенно';
            let checked_str = 'Проверено';
            let checked = e.checked ? 1 : 0;
            let data = {
                "_token": "{{ csrf_token() }}",
                "id": id,
                checked: checked
            };

            axios.post('/admin/words/checkUpdate/'+id, {
                data
            })
            .then(function (response) {
                if(response.data.result){
                    let text_str = checked ? checked_str : unchecked_str;
                    $label.text(text_str);

                    if(checked) {
                        $label.removeClass(worn_class);
                        $label.addClass(success_class);
                    }else{
                        $label.removeClass(success_class);
                        $label.addClass(worn_class);
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
            });
            console.log(data);
        }
    </script>
@stop
