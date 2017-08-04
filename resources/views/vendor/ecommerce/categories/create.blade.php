@extends('dashboard::base')

@section('title', 'Новая категория')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Основное</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Описание</a></li>
                </ul>
                <div class="box-body">
                    {!! $form_builder->model($category, ['url' => '/dashboard/ecommerce/category', 'class' => 'js-submit tab-content', 'method' => 'POST']) !!}
                    @include('ecommerce::categories._form')
                    {!! $form_builder->close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection