@extends('dashboard::base')

@section('title', 'Редактирование пользователя')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($user, ['url' => url('dashboard/users/user/' . $user['id']) , 'method' => 'put', 'class' => 'js-submit']) !!}
                    @include('users::_form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection