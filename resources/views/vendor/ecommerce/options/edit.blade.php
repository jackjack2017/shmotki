@extends('dashboard::base')

@section('title', 'Редактирование опции')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($option, ['url' => 'dashboard/ecommerce/option/'. $option['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
                    @include('ecommerce::options._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection