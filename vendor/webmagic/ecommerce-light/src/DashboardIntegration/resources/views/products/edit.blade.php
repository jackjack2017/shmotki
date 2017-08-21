@extends('dashboard::base')

@section('meta-title', $product['name'])
@section('title')
    {{$product['name']}} <small>редактирование товара</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            {!! $form_builder->model($product, ['url' => '/dashboard/ecommerce/product/'.$product['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
            @include('ecommerce::products._form')
            {!! $form_builder->close() !!}
        </div>
    </div>
@endsection