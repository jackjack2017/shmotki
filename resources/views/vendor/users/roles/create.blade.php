@extends('dashboard::base')
@section('title', 'Добавить роль')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($role, ['url' => url(config('laravel-components.dashboard.users.prefix') . '/role'), 'class' => 'js-submit']) !!}
                    @include('users::roles._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
