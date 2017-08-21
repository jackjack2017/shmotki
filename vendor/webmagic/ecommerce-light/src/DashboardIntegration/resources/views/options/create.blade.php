@extends('dashboard::base')

@section('title', 'Новая опция')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($option, ['url' => '/dashboard/ecommerce/option', 'class' => 'js-submit', 'method' => 'POST']) !!}
                    @include('ecommerce::options._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection