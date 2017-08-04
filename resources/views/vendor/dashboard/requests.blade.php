@extends('dashboard::base')

@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Заявки на ТО</h3>
                <a href="{{url('module/request/export')}}" class="btn btn-xs btn-success pull-right" title="Экспорт в excel">Экспортировать <i class="fa  fa-file-excel-o"></i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body form-inline dt-bootstrap dataTables_wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover dataTable js_data_table">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Название товара</th>
                                <th>Артикл товара</th>
                                <th>Цена</th>
                                <th>Тип формы</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                            <tr>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Название товара</th>
                                <th>Артикл товара</th>
                                <th>Цена</th>
                                <th>Тип формы</th>
                                <th>Дата</th>
                            </tr>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{$request['name']}}</td>
                                    <td>{{$request['phone']}}</td>
                                    <td>{{$request['product_name']}}</td>
                                    <td>{{$request['product_article']}}</td>
                                    <td>{{$request['product_price']}}</td>
                                    <td>{{$request['form_type']}}</td>
                                    <td>{{$request['created_at']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>
@endsection