@extends('dashboard::base')
@section('title', 'Список заявок')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table class=" table table-hover dataTable">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Кол-во заявок</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($types as $type)
                            <tr class="even products-row js_types_{{$type['id']}}">
                                <td>{{$type['name']}}</td>
                                <td>{{$type['count']}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('/dashboard/requests/'.$type['id'].'/look')}}"
                                           class="personals-edit btn btn-success btn-flat" title="Просмотреть заявки"><i
                                                    class="fa fa-eye"></i></a>
                                        <button type="button" data-item=".js_types_{{$type['id']}}"  data-method="DELETE"
                                                data-request="/dashboard/requests/{{$type['alias']}}"
                                                class="js_delete personals-delete btn btn-danger btn-flat"
                                                title="Удалить заявки этого типа"><i class="fa fa-trash"></i></button>
                                        <a href="{{url('dashboard/requests/'.$type['id'].'/export')}}"
                                           class="personals-edit btn btn-info btn-flat" title="Экспорт в excel"><i
                                                    class="fa  fa-file-excel-o"></i> Экспортировать</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection