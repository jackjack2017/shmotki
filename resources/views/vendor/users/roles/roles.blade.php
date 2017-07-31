@extends('dashboard::base')
@section('title', 'Доступные роли')
@section('content')
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a class="btn btn-sm btn-success pull-right" href="{{url(config('laravel-components.dashboard.users.prefix') . '/role/create')}}" data-action="{{url(config('laravel-components.dashboard.users.prefix') . '/role/create')}}"><i class="fa  fa-plus"> </i> Добавить</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover table-bordered">
                    <tbody><tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Роль</th>
                        <th>Описание</th>
                        <th></th>
                    </tr>
                    @foreach($roles as $role)
                        <tr class="js_role_{{$role['id']}}">
                            <td>{{$role['id']}}</td>
                            <td>{{$role['name']}}</td>
                            <td><span class="text-light-blue">{{$role['slug']}}</span></td>
                            <td>{{$role['description']}}</td>
                            <td width="100px">
                                <div class="btn-group">
                                    <a href="{{url(config('laravel-components.dashboard.users.prefix') . '/role/' . $role['id'] . '/edit')}}" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a data-item=".js_role_{{$role['id']}}" data-method="POST"
                                               data-request="{{url(config('laravel-components.dashboard.users.prefix') . '/role/' . $role['id'] . '/destroy')}}"
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
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    </div>
@endsection