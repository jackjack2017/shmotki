@extends('dashboard::base')

@section('title')
    {{$option_group['name']}} <small>редактирование группы опций</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($option_group, ['url' => 'dashboard/ecommerce/option-group/'. $option_group['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
                    @include('ecommerce::option-groups._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
        </div>
    </div>

    <h2><small>Доступные опции</small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div>
                    <a href="{{url('dashboard/ecommerce/option/create/' . $option_group['id'])}}" class="btn btn-sm btn-info pull-right products-btn" title="Создать новую"><i class="fa  fa-plus"> </i> Добавить</a>
                </div>
                <div class="box-body">
                    <table class="js_data_table table table-bordered table-hover dataTable"
                           role="grid" aria-describedby="example2_info" data-searching="false" data-url="{{url('dashboard/ecommerce/option/position/update')}}">
                        <thead>
                        <tr role="row">
                            <th></th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID">ID</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Название">Значение</th>
                            <th class="text-center" rowspan="1" colspan="1" aria-label=""></th>

                        </tr>
                        </thead>
                        <tbody class="js-sortable-with-handler" style="overflow-y: hidden" >
                        @foreach ($option_group['options'] as $option)
                            <tr role="row" id="{{$option['id']}}" class="js_option_{{$option['id']}} even products-row js-sortable-i" >
                                <td width="30px" class="text-center text-light-blue js-sortable-handler ui-sortable-handle" style="cursor: move"><i class="fa  fa-arrows-v"></i></td>
                                <td width="30px" class="sorting_1">{!! $option['id'] !!}</td>
                                <td>{!! $option['value'] !!}</td>
                                <td width="100px">
                                    <div class="btn-group">
                                        <a href="{{url('dashboard/ecommerce/option/' . $option['id']) . '/edit'}}"
                                           class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a data-item=".js_option_{{$option['id']}}" data-method="DELETE"
                                                   data-request="{{url('dashboard/ecommerce/option/' . $option['id'])}}"
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