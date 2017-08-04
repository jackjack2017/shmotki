@extends('dashboard::base')
@section('title', 'Редактирование списка')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($list, ['url' => '/dashboard/options/'.$list['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
                    @include('mailer::_form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection