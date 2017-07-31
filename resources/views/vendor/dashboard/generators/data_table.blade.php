@extends('dashboard::base')

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            {{--<a href="{{url('dashboard/ecommerce/product/export')}}" class="btn btn-sm btn-success pull-right products-btn" title="Экспорт в excel"><i class="fa  fa-file-excel-o"> </i> Экспортировать</a>--}}
            {{--<a href="{{url('dashboard/ecommerce/product/create')}}" class="btn btn-sm btn-info pull-right products-btn" title="Экспорт в excel"><i class="fa  fa-plus"> </i> Новый товар</a>--}}
        </ul>
        <div class="tab-content">
            <div class="row">
                <div class="col-sm-12">
                    <table class=" js_data_table table table-bordered table-hover dataTable"
                           role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            @foreach($fields_data['fields'] as $field_alias)
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="{{$field_alias}}">{{$field_alias}}
                                </th>
                            @endforeach
                            @if($fields_data['actions'] !== false)
                                <th></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($collection as $item)
                            <tr role="row" class="even products-row">
                                @foreach($fields_data['fields'] as $field_name => $field_alias)
                                    <td>{{$item[$field_name]}}</td>
                                @endforeach
                                @if($fields_data['actions'] !== false)
                                    <td>
                                        @foreach($fields_data['actions'] as $action_type => $action_options)
                                            @if($action_type == 'delete')
                                                <button type="button" data-method="{{$action_options['method']}}" data-request="/product/{!! $product['id'] !!}" class="js_delete products-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                {{--<td class="sorting_1">{!! $product['id'] !!}</td>--}}
                                {{--<td>{!! $product['article'] !!}</td>--}}
                                {{--<td>{!! $product['name'] !!}</td>--}}
                                {{--<td>{!! $product['color'] !!}</td>--}}
                                {{--<td>{!! $product['price'] !!}</td>--}}
                                {{--<td class="products-lastcell">--}}
                                    {{--<button type="button" data-method="DELETE" data-request="/product/{!! $product['id'] !!}" class="js_delete products-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>--}}
                                    {{--<a href="{{url('/dashboard/ecommerce/product/' . $product['id'] . '/edit')}}" class="products-edit btn btn-info btn-flat"><i class="fa fa-pencil-square-o"></i></a>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr role="row">
                            @foreach($fields_data['fields'] as $field_alias)
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="{{$field_alias}}">{{$field_alias}}
                                </th>
                            @endforeach
                            @if($fields_data['actions'] !== false)
                                <th></th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
    </div>
@endsection