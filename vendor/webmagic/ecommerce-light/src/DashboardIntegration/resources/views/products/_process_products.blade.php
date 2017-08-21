@extends('dashboard::base')

@section('title', 'Товары')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Все товары</a></li>
                    <li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Импорт</a></li>
                    <div class="pull-right">
                        <a href="{{url('dashboard/ecommerce/product/images/export')}}" class="btn btn-sm btn-success pull-right products-btn" title="Экспортировать изображения товаров в .zip"><i class="fa fa-file-picture-o"> </i> Экспорт изображений</a>
                        <a href="{{url('dashboard/ecommerce/product/export')}}" class="btn btn-sm btn-success pull-right products-btn" title="Экспорт в excel"><i class="fa  fa-file-excel-o"> </i> Экспорт товаров</a>
                        <a href="{{url('dashboard/ecommerce/product/create')}}" class="btn btn-sm btn-info pull-right products-btn" title="Создать новый товар"><i class="fa  fa-plus"> </i> Новый товар</a>
                    </div>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-12">

                                {!! $component_generator->dataTable(
                                    ['id' => 'ID', 'category.name' => ['title' => 'Категория', 'link_key' => 'category.id'], 'name' => 'Название', 'price' => 'Цена', 'Редактировать', 'Удалить'], ['paging' => 100, 'searching' => true], $products) !!}

                                {{--<table class="js_data_table table table-bordered table-hover dataTable" data-searching="true" role="grid" data-page-length='10' aria-describedby="example2_info">--}}
                                    {{--<thead>--}}
                                        {{--<tr role="row">--}}
                                            {{--<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID">ID</th>--}}
                                            {{--<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Категория">Категория</th>--}}
                                            {{--<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Название">Название</th>--}}
                                            {{--<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Цена">Цена</th>--}}
                                            {{--<th class="text-center">Редактировать</th>--}}
                                            {{--<th class="text-center">Удалить</th>--}}
                                        {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@foreach ($products as $product)--}}
                                        {{--<tr role="row" class="even products-row js_product_{{$product['id']}}">--}}
                                            {{--<td class="sorting_1">{!! $product['id'] !!}</td>--}}
                                            {{--<td><a href="{{url('/dashboard/ecommerce/category/' . $product['category']['id'] . '/edit')}}" >{!! $product['category']['name'] !!}</a></td>--}}
                                            {{--<td><a href="{{url('/dashboard/ecommerce/product/' . $product['id'] . '/edit')}}" >{!! $product['name'] !!}</a></td>--}}
                                            {{--<td>{!! $product['price'] !!}</td>--}}
                                            {{--<td class="text-center">--}}
                                                {{--<a href="{{url('/dashboard/ecommerce/product/' . $product['id'] . '/edit')}}" class="products-edit btn btn-info btn-flat"><i class="fa fa-pencil-square-o"></i></a>--}}
                                            {{--</td>--}}
                                            {{--<td class="text-center">--}}
                                                {{--<button type="button" data-item=".js_product_{{$product['id']}}" data-method="DELETE" data-request="{{url('dashboard/ecommerce/product/' . $product['id'])}}" class="js_delete products-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                       <div class="row">
                           <div class="col-md-6 col-xs-12">
                               <div class="box-solid">
                                   <div class="box-body">
                                       {!! $form_builder->open(['url' => '/dashboard/ecommerce/product/import', 'class' => 'js-submit', 'method' => 'POST']) !!}
                                       {!! $component_generator->file('product_import', 'Импорт товаров') !!}
                                       {!! $form_builder->button('Импортировать', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
                                       {!! $form_builder->close() !!}
                                   </div>
                                   <div class="box-footer with-border"></div>
                               </div>
                           </div>
                           <div class="col-md-6 col-xs-12">
                               <div class="box-solid">
                                   <div class="box-body">
                                       {!! $form_builder->open(['url' => '/dashboard/ecommerce/product/images/import', 'class' => 'js-submit', 'method' => 'PUT']) !!}
                                       {!! $component_generator->file('images_import', 'Импорт изображений') !!}
                                       {!! $form_builder->button('Импортировать', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
                                       {!! $form_builder->close() !!}
                                   </div>
                                   <div class="box-footer with-border"></div>
                               </div>
                            </div>
                        </div>
                       </div>
                    </div>
                </div>
                    <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div>


@endsection