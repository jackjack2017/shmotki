@extends('dashboard::base')

@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Зарегистрированный пользователи</h3>
                <button class="btn btn-xs btn-success pull-right js_create" data-action="{{url('module/users/user/create')}}">Добавить пользователя</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody><tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Роль</th>
                        <th></th>
                    </tr>
                    @foreach($users as $user)
                        <tr class="js_user_{{$user['id']}}">
                            <td>{{$user['id']}}</td>
                            <td>{{$user['name']}}</td>
                            <td>{{$user->roles[0]['name']}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-default js_create" data-action="{{url('module/users/user/' . $user['id'] . '/edit')}}" title="Изменить"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger js_delete" data-item=".js_user_{{$user['id']}}" data-request="{{url('module/users/user/' . $user['id'] . '/destroy')}}" title="Удалить"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection