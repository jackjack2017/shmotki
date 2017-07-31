@extends('dashboard::parts._modal-base')

@section('title')
    Редактирование пользователя
@endsection

@section('modal-content')
    {!! Form::model($user, ['url' => '/module/users/user/' . $user['id'] , 'method' => 'put','class' => '']) !!}
    @include('dashboard::users._form')
    {!! Form::close() !!}
@endsection