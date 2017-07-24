@extends('dashboard::base')
@section('title', 'Новый список')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($list, ['url' => '/dashboard/options', 'class' => 'js-submit', 'method' => 'POST']) !!}
                    @include('mailer::_form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection