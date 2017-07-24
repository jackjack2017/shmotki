@extends('dashboard::parts._modal-base')

@section('title')
    Создание пользователя
@endsection

@section('modal-content')

{!! Form::model($user, ['url' => '/module/users/user', 'class' => '']) !!}
@include('dashboard::users._form')
{!! Form::close() !!}
@endsection