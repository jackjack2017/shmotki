@extends('dashboard::base')

@section('title')
    {{$filter['name']}} <small>редактирование фильтра</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $form_builder->model($filter, ['url' => 'dashboard/ecommerce/filter/'. $filter['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
                    @include('ecommerce::filters._form')
                    {!! $form_builder->close() !!}
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h4>Изменение порядка групп опций в фильтре</h4>
                </div>
                <div class="box-body">
                <table class="table table-bordered table-hover dataTable" data-url="{{url('dashboard/ecommerce/option-group/position/update')}}">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Название группы опций</th>
                    </tr>
                    </thead>
                    <tbody style="overflow-y: hidden" class="js-sortable-with-handler" >
                        @foreach($filter['optionGroups'] as $option_group)
                            <tr id="{{$option_group['id']}}" class="js-sortable-handler">
                                <td width="30px" class="text-center text-light-blue js-sortable-handler ui-sortable-handle" style="cursor: move"><i class="fa  fa-arrows-v"></i></td>
                                <td width="30px">{{$option_group['id']}}</td>
                                <td>{{$option_group['name']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection