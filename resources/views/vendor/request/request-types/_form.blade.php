{!! $component_generator->text('name', null, 'Назвaние') !!}
{!! $component_generator->text('alias', null, 'Алиас') !!}
<span class="text-mute">Только латиница. Используеться для генерации роута на прием заявок</span>
{!! $component_generator->textarea('description', null, 'Описание') !!}
{!! $component_generator->select('event', $events, null, 'События') !!}
{!! $component_generator->select('status', array('Выкл','Вкл'), null, 'Отображение формы') !!}


<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class="row">
                <h3 class="box-title col-md-9">Поля заявки</h3>
                <div class="col-md-3">
                    <div class="pull-right btn btn-success js-add">
                        <i class="glyphicon glyphicon-plus-sign"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form>
                <div>
                    <p>
                        {{"Доступные правила валидации можно посмотреть"}}
                        <a href="https://laravel.com/docs/4.2/validation#available-validation-rules">здесь</a>
                    </p>
                </div>
                <div class="js-copy-dest">
                    @foreach($fields as $key => $value)
                        <div class="js-copy-item form-horizontal row form-group">
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="{{$value['name']}}"
                                       name="field_name_{{$key}}">
                            </div>
                            <div class="col-md-3">
                                {!! $form_builder->select("field_type_$key", $types, $value['type'], ['class'=>'form-control'])!!}
                            </div>

                            <div class="col-md-3">
                                <input type="text" class="form-control" value="{{$value['rules']}}"
                                       name="field_rule_{{$key}}">
                            </div>
                            <div class="col-md-3">
                                <div class="pull-right  btn btn-danger js-remove">
                                    <i class="glyphicon glyphicon-remove-circle"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right" title="Сохранить">Submit</button>
        </div>
    </div>
    <!-- /.box -->
</div>

<div class="hidden js-src">
    <div class="js-copy-item form-horizontal row form-group">
        <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Имя поля (латиница)" name="field_name">
        </div>
        <div class="col-md-3">
            {!! $form_builder->select('field_type', $types, null, ['class'=>'form-control'])!!}
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Правила валидации" name="field_rule">
        </div>
        <div class="col-md-3">
            <div class="pull-right  btn btn-danger js-remove">
                <i class="glyphicon glyphicon-remove-circle"></i>
            </div>
        </div>
    </div>
</div>

