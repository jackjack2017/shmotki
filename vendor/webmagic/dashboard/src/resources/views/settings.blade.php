@extends('dashboard::base')

@section('content')
    {{--Request setting--}}
    <div class="col-lg-6">
        {!! Form::open(array('url' => 'foo/bar', 'class' => 'js-submit box')) !!}
            <div class="box-header">
                <h3 class="box-title">Настрояка заявок</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered">
                    <tbody>
                    <tr>
                        <td>Отправлять заявку на почту</td>
                        <td>{!! Form::checkbox('send_on_email', 'true') !!}</td>
                    </tr>
                    <tr>
                        <td>Сохранять заявки в базу</td>
                        <td>{!! Form::checkbox('save_req_to_db', 'true') !!}</td>
                    </tr>
                    <tr>
                        <td>Экспорт заявок</td>
                        <td>{!! Form::checkbox('req_export', 'true') !!}</td>
                    </tr>
                    <tr>
                        <td>Имя файла заявок</td>
                        <td>
                            {!! Form::text('req_export_file_name', '', array('class' => 'form-control')) !!}
                           </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><span class="fa fa-save"> </span> Сохранить</button>
            </div>
        {!! Form::close() !!}
    </div>
    {{--END Request Settings--}}
    {{--Products setting--}}
    <div class="col-lg-6">
        {!! Form::open(array('url' => '/', 'class' => 'js-submit box', 'method' => 'get')) !!}
            <div class="box-header">
                <h3 class="box-title">Настройка товаров</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered">
                    <tbody>
                    <tr>
                        <td>Хранить товары в базе</td>
                        <td>{!! Form::checkbox('prod_in_db', 'true') !!}</td>
                    </tr>
                    <tr>
                        <td>Экспорт товаров</td>
                        <td>{!! Form::checkbox('prod_export', 'true') !!}</td>
                    </tr>
                    <tr>
                        <td>Имя файла товаров</td>
                        <td>{!! Form::text('prod_export_file_name', '', array('class' => 'form-control')) !!}</td>
                    </tr>
                    <tr>
                        <td>Обновление товаров</td>
                        <td>{!! Form::checkbox('prod_update', 'true') !!}</td>
                    </tr>
                    <tr>
                        <td>Экспорт изображений товаров</td>
                        <td>{!! Form::checkbox('prod_img_export', 'true') !!}</td>
                    </tr>
                    <tr>
                        <td>Имя файла изображений товаров</td>
                        <td>{!! Form::text('prod_img_export_file_name', '', array('class' => 'form-control')) !!}</td>
                    </tr>
                    <tr>
                        <td>Обновление изображений товаров</td>
                        <td>{!! Form::checkbox('prod_img_update', 'true') !!}</td>
                    </tr>
                    </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><span class="fa fa-save"> </span> Сохранить</button>
            </div>
        {!! Form::close() !!}
    </div>
    {{--END Products Settings--}}
@endsection