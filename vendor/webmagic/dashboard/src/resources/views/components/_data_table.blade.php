<table class="js_data_table table table-bordered table-hover dataTable"
       data-searching="{{$options['searching']}}" role="grid"
       @if($options['paging'])data-page-length='{{$options['paging']}}' @else data-paging="false" @endif aria-describedby="example2_info">
    <thead>
    {{--<tr role="row">--}}
        {{--<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID">ID</th>--}}
        {{--<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Категория">Категория</th>--}}
        {{--<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Название">Название</th>--}}
        {{--<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Цена">Цена</th>--}}
        {{--<th class="text-center">Редактировать</th>--}}
        {{--<th class="text-center">Удалить</th>--}}
    {{--</tr>--}}
    <tr>
        @foreach($titles as $title)
            @if(gettype($title) === 'array')
                <th>{{$title['title']   , ''}}</th>
            @else
                <th>{{$title, ''}}</th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr role="row" class="even products-row js_product_{{$item['id']}}">
                @foreach($titles as $key => $title)
                    <td>
                        @if(isset($title['link_key']))
                            <a href="{{$item[$key]['link']}}">{{$item[$key]['value']}}</a>
                        @else
                           {{$item[$key]}}
                        @endif
                    </td>
                @endforeach
                {{--<td class="sorting_1">{!! $item['id'] !!}</td>--}}
                {{--<td><a href="{{url('/dashboard/ecommerce/category/' . $item['category']['id'] . '/edit')}}" >{!! $item['category']['name'] !!}</a></td>--}}
                {{--<td><a href="{{url('/dashboard/ecommerce/product/' . $item['id'] . '/edit')}}" >{!! $item['name'] !!}</a></td>--}}
                {{--<td>{!! $item['price'] !!}</td>--}}
                {{--<td class="text-center">--}}
                    {{--<a href="{{url('/dashboard/ecommerce/product/' . $item['id'] . '/edit')}}" class="products-edit btn btn-info btn-flat"><i class="fa fa-pencil-square-o"></i></a>--}}
                {{--</td>--}}
                {{--<td class="text-center">--}}
                    {{--<button type="button" data-item=".js_product_{{$item['id']}}" data-method="DELETE" data-request="{{url('dashboard/ecommerce/product/' . $item['id'])}}" class="js_delete products-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>--}}
                {{--</td>--}}
            </tr>
        @endforeach
    </tbody>
</table>