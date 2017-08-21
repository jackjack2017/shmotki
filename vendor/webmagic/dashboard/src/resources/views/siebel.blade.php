@extends('dashboard::base')

@section('content')
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="@if($menu_control['tab'] === 'options') active @endif"><a aria-expanded="true" href="#tab_1"
                                                                                     data-toggle="tab">Настройки
                        интеграции</a></li>
                <li class="@if($menu_control['tab'] === 'debug') active @endif"><a aria-expanded="false" href="#tab_2"
                                                                                   data-toggle="tab">Отладка</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if($menu_control['tab'] === 'options') active @endif" id="tab_1">
                    <div>
                        <div class="box-header">
                            <h3 class="box-title">Текущие настройки интеграции:</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        {{$config['integration_status']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Host:</strong></td>
                                    <td>
                                        {{$config['host']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>ID интеграции приложения:</strong></td>
                                    <td>
                                        {{$config['app_integration_id']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><em>Настройки дилера:</em></td>
                                </tr>
                                <tr>
                                    <td><strong>Siebel integration ID:</strong></td>
                                    <td>
                                        {{$config['integration_id']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Siebel instance:</strong></td>
                                    <td>
                                        {{$config['instance']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Siebel region integration ID:</strong></td>
                                    <td>
                                        {{$config['region_integration_id']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Siebel trend integration ID:</strong></td>
                                    <td>
                                        {{$config['trend_integration_id']}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane @if($menu_control['tab'] === 'debug') active @endif" id="tab_2">
                    <div>
                        <div class="box-header">
                            <h3 class="box-title">Отладка интеграции:</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            {!! Form::open(array('url' => 'dashboard/options/siebel/debug', 'method' => 'get')) !!}
                            <button class="btn btn-success">Отправить тестовый запрос</button>
                            {!! Form::close() !!}

                            @if($debug_data['errors'])
                                <hr>
                                <div class="alert alert-danger alert-dismissible col-sm-12">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <h4><i class="icon fa fa-ban"></i>Ошибки</h4>
                                    @foreach($debug_data['errors'] as $name => $error)
                                        <p>{{$name}} | {{$error}}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if (isset($debug_data['siebel_user_id']))
                                    <div class="col-sm-12">
                                        <hr>
                                            <div class="form-group @if($debug_data['siebel_user_id']=='') has-error @else has-success @endif ">
                                                <label class="control-label" for="inputSuccess"><i class="fa @if($debug_data['siebel_user_id']=='') fa-times-circle-o @else fa-check @endif"></i> User ID</label>
                                                <input type="text" class="form-control" value="{!! $debug_data['siebel_user_id'] !!}" readonly="readonly">
                                            </div>
                                            <div class="form-group @if($debug_data['siebel_user_id']=='') has-error @else has-success @endif">
                                                <label class="control-label" for="inputSuccess"><i class="fa @if($debug_data['siebel_user_id']=='') fa-times-circle-o @else fa-check @endif"></i> Request ID</label>
                                                <input type="text" class="form-control" readonly="readonly" value="{!! $debug_data['siebel_request_id'] !!}">
                                            </div>
                                        <hr>
                                    </div>
                            @endif
                            {!! Form::open() !!}
                            <hr>
                            <h4>Создание клиента</h4>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('flow4Request', 'Запрос на создание клиента') !!}
                                    {!! Form::textarea('flow4Request', $debug_data['flow4_request'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('flow4Response', 'Ответ с сервер') !!}
                                    {!! Form::textarea('flow4Response', $debug_data['flow4_response'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <hr>
                            <h4>Создание заявки</h4>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('flow10Request', 'Запрос на создание заявки') !!}
                                    {!! Form::textarea('flow10Request', $debug_data['flow10_request'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('flow10Response', 'Ответ с сервер') !!}
                                    {!! Form::textarea('flow10Response', $debug_data['flow10_response'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>
@endsection