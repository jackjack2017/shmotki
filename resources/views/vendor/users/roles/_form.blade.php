<div class="form-group">
    {!! $form_builder->label('Имя', null) !!}
    {!! $form_builder->text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! $form_builder->label('Тип прав (tag)', null) !!}
    {!! $form_builder->text('slug', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! $form_builder->label('Описание', null) !!}
    {!! $form_builder->textarea('description', null, ['class'=>'form-control']) !!}
</div>
{{--<div class="form-group">--}}
    {{--{!! $form_builder->label('Уровень прав', null) !!}--}}
    {{--{!! $form_builder->text('level', 1, ['class' => 'form-control']) !!}--}}
{{--</div>--}}
<hr>
<h4>Права</h4>
@foreach($permissions as $permission)
    <div class="form-group">
        {!! $form_builder->checkbox('permissions[' . $permission['slug'] . ']', null, isset($attached_permissions[$permission['slug']])) !!}
        {!! $form_builder->label($permission['name'], null) !!} (<span class="text-green">{{$permission['slug']}}</span>)
    </div>
@endforeach
<div class="box-footer">
    <button type="submit" class="btn btn-primary"><span class="fa fa-save"> </span> Сохранить</button>
</div>
