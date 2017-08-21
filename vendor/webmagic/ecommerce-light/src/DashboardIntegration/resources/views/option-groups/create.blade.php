@extends('dashboard::base')

@section('title', 'Новая группа опций')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($option_group, ['url' => '/dashboard/ecommerce/option-group', 'class' => 'js-submit', 'method' => 'POST']) !!}
                    @include('ecommerce::option-groups._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection