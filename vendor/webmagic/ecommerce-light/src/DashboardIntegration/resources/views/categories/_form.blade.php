<div class="tab-pane active" id="tab_1">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-xs-12">
            {!! $component_generator->imageLoad('img', 'Изображение', isset($category['img']) ? $category->present()->mainImage() : '') !!}

        </div>
        <div class="col-lg-8 col-md-6 col-xs-12">
            {!! $component_generator->checkbox('active', 'Отметка активности', null, isset($category['active']) ? $category['active'] : '', ['class' => 'js-switch', 'data-secondary'=>"#dd4b39"]) !!}
            {!! $component_generator->text('name', null, 'Название') !!}
            {!! $component_generator->text('slug    ', null, 'Ссылка') !!}
            {!! $component_generator->text('title', null, 'Заголовок') !!}
            {!! $component_generator->select('parent_id', array_prepend($categories, '-', 0), null, 'Родительская категория') !!}

            @if(config('webmagic.ecommerce.filter_use'))
                {!! $component_generator->select('filter_id', array_prepend($filters, '-', -1), null, 'Фильтр для категории') !!}
            @endif
            @if(!$options->isEmpty())
                <div class="form-group">
                    <label>Группы опций</label>
                    <select name="option_groups[]" class="js-select2 col-md-12" multiple="multiple">
                        @foreach($options as $option)
                            <option value="{{$option['id']}}" @if(strrpos($category['option_groups'], strval($option['id']))) selected="selected" @endif>{{$option['name']}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="tab-pane" id="tab_2">
    {!! $component_generator->textareaWYSIHTML5('description', null, 'Описание') !!}


    {!! $component_generator->text('meta_title', null, 'Мета заголовок') !!}
    {!! $component_generator->text('meta_description', null, 'Мета описание') !!}
    {!! $component_generator->text('meta_keywords', null, 'Ключевые слова') !!}
</div>
<div class="tab-pane" id="tab_3">
    {!! $component_generator->imageLoad('images', 'Галерея', isset($category['images']) ? $category->present()->gallery : '', ['multiple' => '']) !!}
</div>


<div class="box-footer">
    <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
</div>