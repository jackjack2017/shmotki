    <div class="form-group">
        {!! Form::label('Логин', null) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Пароль', null) !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Подтвердите пароль', null) !!}
        {!! Form::password('password_confirm', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Роль', null) !!}
        {!! Form::select('role_slug', $roles, null, ['class'=>'form-control']) !!}
    </div>
<!-- /.box-body -->
<div class="box-footer">
    <button type="submit" class="btn btn-primary"><span class="fa fa-save"> </span> Сохранить</button>
</div>