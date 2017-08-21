@extends('dashboard::base')

@section('content')
    <div class="col-xs-12">
        <form class="box js-submit" method="post" action="/module/mailer/list/edit">
            <div class="box-header">
                <h3 class="box-title">Списки получателей</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered">
                    <tbody><tr>
                        <th>Название</th>
                        <th>Список адресов</th>
                    </tr>
                    @foreach($lists as $list)
                        <tr>
                            <td>{{$list['tag']}}</td>
                            <td><textarea class="form-control" rows="3" name="{{$list['id']}}">{{$list['emails']}}</textarea>
                            </td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><span class="fa fa-save"> </span> Сохранить</button>
            </div>
        </form>
        <!-- /.box -->

    </div>
@endsection