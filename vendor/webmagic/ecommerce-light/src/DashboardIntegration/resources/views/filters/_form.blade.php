{!! $component_generator->text('name', null, 'Название') !!}

<label for="option-groups">Выбранные группы опций</label>
<select id="option-groups" name="option_groups" class="js-select2 col-md-12" multiple="multiple">
    @foreach($option_groups as $id => $name)
        <option value="{{$id}}" @if(isset($filter['option_groups'][$id])) selected="selected" @endif>{{$name}}</option>
    @endforeach
</select>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
