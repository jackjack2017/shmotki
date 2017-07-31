{!! $component_generator->text('value', null, 'Значение') !!}
{!! $component_generator->select('option_group_id', $option_groups, null, 'Группа опций') !!}
<div class="row">
<div class="col-md-1">
{!! $component_generator->text('color', null, 'Цвет', ['class'=>' js-color-pick']) !!}
</div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
