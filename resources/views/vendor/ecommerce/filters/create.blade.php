@extends('dashboard::base')

@section('title', 'Новый фильтр')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($filter, ['url' => '/dashboard/ecommerce/filter', 'class' => 'js-submit', 'method' => 'POST']) !!}
                    @include('ecommerce::filters._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection