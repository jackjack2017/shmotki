@extends('dashboard::base')

@section('title', 'Списки получателей')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="pull-right">
                    <a href="{{url('dashboard/options/create')}}" class="btn btn-sm btn-success pull-right personals-btn products-btn" title="Создать новый товар"><i class="fa  fa-plus"> </i> Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover dataTable">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Тема письма</th>
                            <th>Шабол письма</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $list)
                            <tr class="js_personal_{{$list['id']}}" >
                                <td>{{$list['slug']}}</td>
                                <td>{{$list['subject']}}</td>
                                <td>{{$list['email_templates']}}</td>
                                <td width="70px">
                                    <div class="btn-group">
                                        <a href="{{url('dashboard/options/' . $list['id'] . '/edit')}}" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a data-item=".js_personal_{{$list['id']}}" data-method="DELETE"
                                                   data-request="{{url('/dashboard/options/'. $list['id'])}}"
                                                   class="js_delete products-delete">Удалить</a>
                                            </li>
                                        </ul>
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
@endsection