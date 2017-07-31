 <div class="form-group">
        {!! $form_builder->label('Логин', null) !!}
        {!! $form_builder->text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! $form_builder->label('Пароль', null) !!}
        {!! $form_builder->password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! $form_builder->label('Подтвердите пароль', null) !!}
        {!! $form_builder->password('password_confirm', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! $form_builder->label('Роли', null) !!}
        <select name="roles" multiple="multiple" class="form-control js-select2">
            @foreach($roles as $role_id => $role_name)
                <option value="{{$role_id}}"
                        @if(isset($user['user_roles'][$role_id])) selected="selected" @endif
                >{{$role_name}}</option>
            @endforeach
        </select>
    </div>
 <div class="form-group">
     {!! $form_builder->label('Дополнительные права', null) !!}
     <select name="permissions" multiple="multiple" class="form-control js-select2">
         @foreach($permissions as $permission_id => $permission_name)
             <option value="{{$permission_id}}"
                     @if(isset($user['user_permissions'][$permission_id])) selected="selected" @endif
             >{{$permission_name}}</option>
         @endforeach
     </select>
 </div>

    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><span class="fa fa-save"> </span> Сохранить</button>
    </div>