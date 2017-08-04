
{!! $form_builder->label('Имя', null) !!}
{!! $form_builder->text('name', null, ['class' => 'form-control']) !!}
{!! $form_builder->label('Тип прав', null) !!}
{!! $form_builder->text('slug',null, ['class' => 'form-control']) !!}
{!! $form_builder->label('Описание', null) !!}
{!! $form_builder->textarea('description', null, ['class'=>'form-control']) !!}

<!-- /.box-body -->
<div class="box-footer">
    <button type="submit" class="btn btn-primary"><span class=""> </span> Сохранить</button>
</div>
