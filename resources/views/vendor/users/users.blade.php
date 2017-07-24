@extends('dashboard::base')
@section('title', 'Пользователи')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a class="btn btn-sm btn-success pull-right"
                            href="{{url('dashboard/users/user/create')}}">
                        <i class="fa  fa-plus"> </i> Добавить
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover  table-bordered">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Логин</th>
                                    <th>Роль</th>
                                    <th></th>
                                </tr>
                                @foreach($users as $user)
                                    <tr class="js_user_{{$user['id']}}">
                                        <td>{{$user['id']}}</td>
                                        <td>{{$user['name']}}</td>
                                        <td>@if(isset($user->roles[0]))
                                                @foreach($user->roles as $role)
                                                    {{$role['name']}} <br>
                                                @endforeach
                                            @else - @endif</td>
                                        <td width="100px">
                                            <div class="btn-group">
                                                <a class="btn btn-info" href="{{url('dashboard/users/user/' . $user['id'] . '/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a data-item=".js_user_{{$user['id']}}" data-method="POST"
                                                           data-request="{{url('dashboard/users/user/' . $user['id'] . '/destroy')}}"
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection