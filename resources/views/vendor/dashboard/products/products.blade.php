@extends('dashboard::base')

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Live style</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Детские акксессуары</a></li>
            <li><a href="#tab_3" data-toggle="tab">Модели Автомобилей</a></li>
            <a href="{{url('products/product/export')}}" class="btn btn-sm btn-success pull-right products-btn" title="Экспорт в excel"><i class="fa  fa-file-excel-o"> </i> Экспортировать</a>
            <a href="{{url('products/product/create')}}" class="btn btn-sm btn-info pull-right products-btn" title="Экспорт в excel"><i class="fa  fa-plus"> </i> Новый товар</a>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-sm-12">
                        <table class=" js_data_table table table-bordered table-hover dataTable"
                               role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="ID">ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Артикул">Артикул
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Название">Название
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Цвет">Цвет
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Цена">Цена
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Коллекция">Коллекция
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Короткое описание">Короткое описание
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products['life_style'] as $product)
                                <tr role="row" class="even products-row">
                                    <td class="sorting_1">{!! $product['id'] !!}</td>
                                    <td>{!! $product['article'] !!}</td>
                                    <td>{!! $product['name'] !!}</td>
                                    <td>{!! $product['color'] !!}</td>
                                    <td>{!! $product['price'] !!}</td>
                                    <td>{!! $product['collection'] !!}</td>
                                    <td class="products-lastcell">
                                        <button type="button" data-method="DELETE" data-request="/product/{!! $product['id'] !!}" class="js_delete products-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                        <a href="/products/product/{!! $product['id'] !!}/edit" class="products-edit btn btn-info btn-flat"><i class="fa fa-pencil-square-o"></i></a>

                                        {!! $product['short_description'] !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="ID">ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Артикул">Артикул
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Название">Название
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Цвет">Цвет
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Цена">Цена
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Коллекция">Коллекция
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Короткое описание">Короткое описание
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <table class=" js_data_table table table-bordered table-hover dataTable"
                       role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-sort="ascending"
                            aria-label="ID">ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Артикул">Артикул
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Название">Название
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цвет">Цвет
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цена">Цена
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Коллекция">Коллекция
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Короткое описание">Короткое описание
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products['kids'] as $product)
                        <tr role="row" class="even products-row">
                            <td class="sorting_1">{!! $product['id'] !!}</td>
                            <td>{!! $product['article'] !!}</td>
                            <td>{!! $product['name'] !!}</td>
                            <td>{!! $product['color'] !!}</td>
                            <td>{!! $product['price'] !!}</td>
                            <td>{!! $product['collection'] !!}</td>
                            <td class="products-lastcell">
                                <button type="button" data-method="DELETE" data-request="/product/{!! $product['id'] !!}" class="js_delete products-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                <a href="/products/product/{!! $product['id'] !!}/edit" class="products-edit btn btn-info btn-flat"><i class="fa fa-pencil-square-o"></i></a>

                                {!! $product['short_description'] !!}
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-sort="ascending"
                            aria-label="ID">ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Артикул">Артикул
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Название">Название
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цвет">Цвет
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цена">Цена
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Коллекция">Коллекция
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Короткое описание">Короткое описание
                        </th>
                    </tr>
                    </tfoot>
                </table>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <table class=" js_data_table table table-bordered table-hover dataTable"
                       role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-sort="ascending"
                            aria-label="ID">ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Артикул">Артикул
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Название">Название
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цвет">Цвет
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цена">Цена
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Коллекция">Коллекция
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Короткое описание">Короткое описание
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products['cars'] as $product)
                        <tr role="row" class="even products-row">
                            <td class="sorting_1">{!! $product['id'] !!}</td>
                            <td>{!! $product['article'] !!}</td>
                            <td>{!! $product['name'] !!}</td>
                            <td>{!! $product['color'] !!}</td>
                            <td>{!! $product['price'] !!}</td>
                            <td>{!! $product['collection'] !!}</td>
                            <td class="products-lastcell">
                                <button type="button" data-method="DELETE" data-request="/product/{!! $product['id'] !!}" class="js_delete products-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                <a href="/products/product/{!! $product['id'] !!}/edit" class="products-edit btn btn-info btn-flat"><i class="fa fa-pencil-square-o"></i></a>

                                {!! $product['short_description'] !!}
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-sort="ascending"
                            aria-label="ID">ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Артикул">Артикул
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Название">Название
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цвет">Цвет
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Цена">Цена
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Коллекция">Коллекция
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                            aria-label="Короткое описание">Короткое описание
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>

    <div class="box">
        <div class="box-header">Импорт товаров</div>
        <div class="box-body">
                <form action="{{url('products/product/import')}}" method="post" class="js-file-init">
                    <div class="form-group">
                        <label for="exampleInputFile">Выберите файл</label>
                        <input type="file" id="exampleInputFile" name="import_file">


                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
            </form>
        </div>
        <div class="box-footer"></div>
    </div>

    <div class="box">
        <div class="box-header">Импорт изображений товаров</div>
        <div class="box-body">
            <form action="{{url('products/product/import')}}" method="post" class="js-file-init">
                <div class="form-group">
                    <label for="exampleInputFile">Выберите файл</label>
                    <input type="file" name="import_image_file">


                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        </div>
        <div class="box-footer"></div>
    </div>
@endsection