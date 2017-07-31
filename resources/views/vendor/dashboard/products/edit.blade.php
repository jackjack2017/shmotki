@extends('dashboard::base')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Редактирование товара</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::model($product, ['url' => '/products/product/'.$product['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
                @include('dashboard::products._form')
                {!! Form::close() !!}
            </div>
        </div>


        <!-- /.box -->
    </div>
@endsection