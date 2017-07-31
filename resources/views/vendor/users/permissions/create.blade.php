@extends('dashboard::base')
@section('title', 'Добавить права')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($permission, ['url' => url(config('laravel-components.dashboard.users.prefix') . '/permission'), 'class' => 'js-submit']) !!}
                    @include('users::permissions._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
