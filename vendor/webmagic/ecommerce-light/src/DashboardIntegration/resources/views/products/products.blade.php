@extends('dashboard::base')

@section('title')
    Товары <span class="badge bg-gray pull-right"><span
                class="badge bg-yellow">выведено {{$products->total()}}</span> <span
                class="badge bg-gray-light">всего {{isset($products_data['total']) ?  $products_data['total'] : ''}}</span> <span class="badge bg-green">активных {{isset($products_data['active']) ? $products_data['active'] : ''}}</span> <span
                class="badge bg-black">архивных {{isset($products_data['un_active']) ? $products_data['un_active'] : ''}}</span></span>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Все товары</a></li>
                    @if (config('webmagic.ecommerce.exchange_products') || config('webmagic.ecommerce.exchange_images'))
                        <li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Экспорт</a></li>
                        <li><a href="#tab_3" data-toggle="tab" aria-expanded="true">Импорт</a></li>
                    @endif
                    <div class="pull-right">
                        <a href="{{url('dashboard/ecommerce/product/create')}}"
                           class="btn btn-sm btn-info pull-right products-btn" title="Создать новый товар"><i
                                    class="fa  fa-plus"> </i> Новый товар</a>
                    </div>
                </ul>
                <div class="tab-content box-body">
                    <div class="tab-pane active" id="tab_1">
                        {{-- Filter --}}
                        @if(config('webmagic.dashboard.ecommerce.filter_use'))
                            {!! $form_builder->open(['url' => url('dashboard/ecommerce/product'), 'class' => 'col-md-8', 'method' => 'PUT']) !!}
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! $form_builder->label('Поиск по имени:', null) !!}
                                    <input type="text" name="product_name" class="form-control"
                                           value="{{$filter['product_name']}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! $form_builder->label('Категории:', null) !!}
                                    <select name="categories[]" multiple="multiple" class="js-select2 form-control">
                                        @foreach($categories as $category_id => $category_name)
                                            <option @if(in_array($category_id, $filter['categories'])) selected
                                                    @endif value="{{$category_id}}">{{$category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    {!! $form_builder->label('', null) !!}
                                    {!! $form_builder->button('Фильтровать', ['class' => 'btn btn-primary form-control', 'type'=>'submit']) !!}
                                </div>
                            </div>
                            {!! $form_builder->close() !!}
                        @endif
                        {{-- END Filter --}}
                        {{-- Pagination --}}
                        <div class="form-group col-md-2 pull-right">
                            @if(config('webmagic.dashboard.ecommerce.pagination_use'))
                                <form class="js-send change js-form-cool  pull-right" method="get"
                                      action="{{url('dashboard/ecommerce/product/')}}">
                                    <div class="form-group">
                                        <label>Показывать по:</label>
                                        <select name="size" data-form=".js-form-cool" aria-controls="example1"
                                                class="js-send-change form-control input-sm">
                                            <option value="10" @if($products->perPage() == 10) selected @endif>
                                                10
                                            </option>
                                            <option value="25" @if($products->perPage() == 25) selected @endif>
                                                25
                                            </option>
                                            <option value="50" @if($products->perPage() == 50) selected @endif>
                                                50
                                            </option>
                                            <option value="100"
                                                    @if($products->perPage() == 100) selected @endif>100
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            @endif
                        </div>
                        {{-- END Pagination --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="@if(!config('webmagic.dashboard.ecommerce.pagination_use')) js_data_table @endif table table-bordered table-hover dataTable"
                                       role="grid"
                                       aria-describedby="example2_info"
                                       data-url="{{url('dashboard/ecommerce/product/position/update')}}">
                                    <thead>
                                    <tr role="row">
                                        <th></th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending" aria-label="ID">ID
                                        </th>

                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1" aria-label="Категория">Категория
                                            </th>

                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Название">Название
                                        </th>
                                        <th></th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Цена">Цена
                                        </th>
                                        <th class="text-center"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="js-sortable-with-handler" style="overflow-y: hidden;">
                                    @foreach ($products as $product)
                                        <tr role="row" id="{{$product['id']}}"
                                            class="even products-row js_product_{{$product['id']}} js-sortable-i">
                                            <td class="text-center text-light-blue js-sortable-handler"
                                                style="cursor: move"><i class="fa  fa-arrows-v"></i></td>
                                            <td class="sorting_1">{!! $product['id'] !!}</td>

                                                <td>
                                                    <a href="{{url('/dashboard/ecommerce/category/' . $product['category_id'] . '/edit')}}">
                                                        {!! isset($product['category']['name']) ? $product['category']['name'] : $product['category']!!}</a>
                                                </td>

                                            <td>
                                                <a href="{{url('/dashboard/ecommerce/product/' . $product['id'] . '/edit')}}">{!! $product['name'] !!}</a>
                                            </td>

                                            <td style="min-width: 30px;" class="text-center">
                                                @if($product['active'])
                                                    <small class="label label-success" data-toggle="tooltip"
                                                           title="Активен"><i class="fa fa-check"></i></small>
                                                @else
                                                    <small class="label label-danger" data-toggle="tooltip"
                                                           title="Не активен"><i class="fa fa-close"></i></small>
                                                @endif
                                            </td>
                                            <td>{!! $product['price'] !!}</td>
                                            <td class="text-center" style="min-width: 80px;">
                                                <div class="btn-group">
                                                    <a href="{{url('/dashboard/ecommerce/product/' . $product['id'] . '/edit')}}"
                                                       class="products-edit btn btn-xs btn-info"><i
                                                                class="fa fa-pencil-square-o"></i></a>
                                                    <button type="button" class="btn btn-xs btn-info dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{url('dashboard/ecommerce/product/' . $product['id'] . '/copy')}}">Копировать</a>
                                                            <a data-item=".js_product_{{$product['id']}}"
                                                               data-method="DELETE"
                                                               data-request="{{url('dashboard/ecommerce/product/' . $product['id'])}}"
                                                               class="js_delete products-delete">Удалить
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if(config('webmagic.dashboard.ecommerce.pagination_use'))
                                    @include('ecommerce::products.pagination', ['paginator' => $products])
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (config('webmagic.ecommerce.exchange_products') || config('webmagic.ecommerce.exchange_images'))
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="box-solid">
                                        @if (config('webmagic.ecommerce.exchange_products'))
                                            <div class="box-body">
                                                <h3 class="text-info">Экспорт товаров</h3>
                                                {!! $form_builder->open(['url' => url('dashboard/ecommerce/product/export'), 'class' => 'col-md-12', 'method' => 'PUT']) !!}

                                                    <div class="col-md-6">
                                                        <p>{!! $form_builder->label('Категории для экспорта:', null) !!}</p>
                                                        <div class="form-group">
                                                            <select name="categories[]" multiple="multiple"
                                                                    class="form-control">
                                                                @foreach($categories as $category_id => $category_name)
                                                                    <option value="{{$category_id}}">{{$category_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            {!! $form_builder->checkbox('all_categories', null, 1) !!}
                                                            {!! $form_builder->label('Все категории', null) !!}
                                                        </div>
                                                    </div>

                                                <div class="col-md-6">
                                                    <p>{!! $form_builder->label('Поля для экспорта:', null) !!}</p>
                                                    <div class="form-group">
                                                        <select name="fields[]" multiple="multiple"
                                                                class=" form-control">
                                                            @foreach(config('webmagic.ecommerce.export_labels') as $category_id => $category_name)
                                                                <option value="{{$category_id}}">{{$category_name}}</option>
                                                            @endforeach
                                                            <option value="delete">Удалить</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        {!! $form_builder->checkbox('all_fields', null, 1) !!}
                                                        {!! $form_builder->label('Все поля', null) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {!! $form_builder->button('Экспортировать', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
                                                </div>
                                                {!! $form_builder->close() !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="row">
                                @if (config('webmagic.ecommerce.exchange_products'))
                                    <div class="col-md-6 col-xs-12">
                                        <div class="box-solid">

                                            <div class="box-body">
                                                {!! $form_builder->open(['url' => url('dashboard/ecommerce/product/import'), 'class' => 'js-submit form-inline', 'method' => 'PUT']) !!}
                                                <div class="form-group col-md-5">
                                                    {!! $component_generator->file('product_import', 'Импорт товаров') !!}
                                                </div>
                                                <div class="form-group col-md-3">
                                                    {!! $form_builder->button('Импортировать', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
                                                </div>
                                                {!! $form_builder->close() !!}
                                            </div>

                                            <div class="box-footer">
                                                {!! $form_builder->open(['url' => url('dashboard/ecommerce/product/import/backup'), 'class' => 'js-submit', 'method' => 'POST']) !!}
                                                <div class="form-group col-md-3">
                                                    {!! $form_builder->button('Отменить последний импорт', ['class' => 'btn btn-danger products-btn', 'type'=>'submit']) !!}
                                                </div>
                                                {!! $form_builder->close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div>

@endsection