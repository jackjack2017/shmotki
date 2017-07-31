@extends('dashboard::base')
@section('title', 'Типы форм')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="pull-right">
                    <a href="{{url('dashboard/requests/request-type/create')}}"
                       class="btn btn-sm btn-info pull-right personals-btn products-btn" title="Создать новый тип заявок"><i
                                class="fa  fa-plus"> </i> Новый тип</a>
                </div>
                <div class="box-body">
                    <table class=" table table-hover dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Алиас</th>
                            <th>Имя</th>
                            <th>Описание</th>
                            <th>События</th>
                            <th>Отображение формы</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr class="even products-row js_type_{{$type['id']}}">
                                <td>{{$type['id']}}</td>
                                <td>{{$type['alias']}}</td>
                                <td>{{$type['name']}}</td>
                                <td>{{$type['description']}}</td>
                                <td>{{$type['event']}}</td>
                                @if($type['status'])
                                    <td>Вкл</td>
                                @else
                                    <td>Выкл</td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <button type="button" data-item=".js_type_{{$type['id']}}" data-method="DELETE"
                                                data-request="/dashboard/requests/request-type/{{$type['id']}}/{{$type['alias']}} "
                                                class="js_delete personals-delete btn btn-danger btn-flat"
                                                title="Удалить тип и заявки"><i class="fa fa-trash"></i></button>
                                        <a href="{{url('/dashboard/requests/request-type/'.$type['id'].'/edit')}}"
                                           class="personals-edit btn btn-info btn-flat"
                                           title="Редактирование типов и полей"><i
                                                    class="fa fa-pencil-square-o"></i></a>
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