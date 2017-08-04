@extends('dashboard::base')

@section('title', 'Все доступные группы опций')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div>
                    <a href="{{url('dashboard/ecommerce/option-group/create')}}" class="btn btn-sm btn-info pull-right products-btn" title="Создать новую каегорию"><i class="fa  fa-plus"> </i> Добавить</a>
                </div>
                <div class="box-body">
                    <table class="js_data_table table table-bordered table-hover dataTable"
                           role="grid" aria-describedby="example2_info" data-searching="true">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID">ID</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Название">Название</th>
                            <th class="text-center" rowspan="1" colspan="1" aria-label=""></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($option_groups as $option_group)
                            <tr role="row" class="js_option-group_{{$option_group['id']}} even products-row ">
                                <td class="sorting_1">{!! $option_group['id'] !!}</td>
                                <td><a href="{{url('dashboard/ecommerce/option-group/' . $option_group['id']) . '/edit'}}">{!! $option_group['name'] !!}</a></td>
                                <td width="100px">
                                    <div class="btn-group">
                                        <a href="{{url('dashboard/ecommerce/option-group/' . $option_group['id']) . '/edit'}}"
                                           class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a data-item=".js_option-group_{{$option_group['id']}}" data-method="DELETE"
                                                   data-request="{{url('dashboard/ecommerce/option-group/' . $option_group['id'])}}"
                                                   class="js_delete products-delete">Удалить</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection