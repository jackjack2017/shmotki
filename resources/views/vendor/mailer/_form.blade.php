<div class="form-group">
    <label for="page_name" class="control-label">Имя</label>
    {!! $form_builder->text('tag', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="page_price" class="control-label">Адреса</label>
    {!! $form_builder->textarea('emails', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="page_price" class="control-label">Тема письма</label>
    {!! $form_builder->text('subject', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="page_price" class="control-label">Описание</label>
    {!! $form_builder->text('description', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label class="control-label">Шаблон письма</label>
    {!! $form_builder->select('email_templates', $templates, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group" >
    <label class="control-label">Событие</label>
    {!! $form_builder->select('events', $events, null, ['class'=>'form-control']) !!}
</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>