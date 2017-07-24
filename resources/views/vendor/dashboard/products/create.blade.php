@extends('dashboard::base')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Создание товара</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::model($product, ['url' => '/products/product', 'class' => 'js-submit', 'method' => 'POST']) !!}
                @include('dashboard::products._form')
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box -->
    </div>
@endsection