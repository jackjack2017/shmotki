@extends('dashboard::base')

@section('title', 'Новый тип заявок')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model('',['url' => 'dashboard/requests/request-type', 'method'=> 'post', 'class' => 'js-submit']) !!}
                    @include('request::request-types._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection