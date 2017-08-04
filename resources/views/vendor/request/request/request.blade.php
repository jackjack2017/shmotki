@extends('dashboard::base')
@section('title', $name)
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h4>Роут для регистрации заявок: /request/create/{{$name}}</h4>
                </div>
                <div class="pull-right">
                    <a href="{{url('dashboard/requests/'.$id.'/export')}}" class="btn btn-sm btn-success pull-right products-btn" title="Экспорт в excel"><i class="fa  fa-file-excel-o"></i> Экспортировать</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover dataTable">
                        <thead>
                        <tr>
                            <th>id</th>
                            @foreach($fields as $field)
                                <th>{{$field['name']}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($req_fields as $id => $field)
                            @foreach($field as $key => $value)
                                <td>{{$value}}</td>
                            @endforeach
                            <td>
                                <div class="btn-group">
                                    <button type="button" data-method="DELETE" data-request="/dashboard/requests/{{$req_fields[$id]->id}}/{{$name}}" class="js_delete personals-delete btn btn-danger btn-flat" title="Удалить заявку" ><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                            <tr></tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection