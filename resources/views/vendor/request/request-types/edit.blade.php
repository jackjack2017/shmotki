@extends('dashboard::base')

@section('title', 'Редактирование типа')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h4>Роут для регистрации заявок: /request/create/{{$type['alias']}}</h4>
                </div>
                <div class="box-body">
                    {!! $form_builder->model($type, ['url' => '/dashboard/requests/request-type/'.$type['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
                    @include('request::request-types._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection