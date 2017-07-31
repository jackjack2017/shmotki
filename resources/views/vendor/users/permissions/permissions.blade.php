@extends('dashboard::base')
@section('title', 'Добавить права')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <a class="btn btn-sm btn-success pull-right"
                       href="{{url(config('laravel-components.dashboard.users.prefix') . '/permission/create')}}"
                       data-action="{{url(config('laravel-components.dashboard.users.prefix') . '/permission/create')}}"><i class="fa  fa-plus"> </i> Добавить</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Тип прав</th>
                                    <th>Описание</th>
                                    <th width="70px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr class="js_permission_{{$permission['id']}}">
                                        <td>{{$permission['id']}}</td>
                                        <td>{{$permission['name']}}</td>
                                        <td><span class="text-green">{{$permission['slug']}}</span></td>
                                        <td>{{$permission['description']}}</td>
                                        <td width="100px">
                                            <div class="btn-group">
                                                <a href="{{url(config('laravel-components.dashboard.users.prefix') . '/permission/' . $permission['id'] . '/edit')}}" class="btn btn-info" data-action="{{url(config('laravel-components.dashboard.users.prefix') . '/permission/' . $permission['id'] . '/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a data-item=".js_permission_{{$permission['id']}}" data-method="POST"
                                                           data-request="{{url(config('laravel-components.dashboard.users.prefix') . '/permission/' . $permission['id'] . '/destroy')}}"
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