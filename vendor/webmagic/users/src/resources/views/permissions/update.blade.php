@extends('dashboard::parts._modal-base')

@section('title')
    Редактирование пользователя
@endsection

@section('modal-content')
    {!! $form_builder->model($permission, ['url' => url(config('laravel-components.dashboard.users.prefix') . '/permission/' . $permission['id']) , 'method' => 'put']) !!}
    @include('users::permissions._form')
    {!! $form_builder->close() !!}
@endsection