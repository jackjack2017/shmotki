@extends('dashboard::base')

@section('title')
    {{$category['name']}} <small>редактирование категории</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Основное</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Описание</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Галерея</a></li>
                </ul>
                <div class="box-body">
                    {!! $form_builder->model($category, ['url' => '/dashboard/ecommerce/category/'.$category['id'], 'class' => 'js-submit tab-content', 'method' => 'PUT']) !!}
                    @include('ecommerce::categories._form')
                    {!! $form_builder->close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection