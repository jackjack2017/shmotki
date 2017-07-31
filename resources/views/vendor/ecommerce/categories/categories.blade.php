@extends('dashboard::base')

@section('title', 'Категории')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="clearfix">
                    <a href="{{url('dashboard/ecommerce/category/create')}}"
                       class="btn btn-sm btn-success pull-right products-btn" title="Создать новую каегорию"><i
                                class="fa  fa-plus"> </i> Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>
                                Название
                            </th>
                            <th>
                                Активна
                            </th>
                            <th>
                            </th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    @for($i=0; $i <= $category['level']; $i++)
                                        -
                                    @endfor
                                    {{$category->name}}
                                </td>
                                <td>
                                    @if($category['active'])
                                        <small class="label label-success" data-toggle="tooltip"
                                               title="Активна"><i class="fa fa-check"></i>
                                        </small>
                                    @else
                                        <small class="label label-danger" data-toggle="tooltip"
                                               title="Не активна"><i class="fa fa-close"></i>
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('dashboard/ecommerce/category/' . $category['id']) . '/edit'}}"
                                           class="products-edit btn btn-xs btn-info"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                        <button type="button"
                                                class="btn btn-xs btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a data-item=".js_category_{{$category['id']}}"
                                                   data-method="DELETE"
                                                   data-request="{{url('dashboard/ecommerce/category/' . $category['id'])}}"
                                                   class="js_delete products-delete">Удалить</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection