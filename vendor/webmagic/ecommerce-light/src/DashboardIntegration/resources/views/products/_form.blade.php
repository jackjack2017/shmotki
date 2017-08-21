<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Основное</a></li>
                <li><a href="#tab_2" data-toggle="tab" aria-expanded="false">Описание</a></li>
                @if(config('webmagic.ecommerce.filter_use'))
                    <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">Опции</a></li>
                @endif
                <li><a href="#tab_4" data-toggle="tab" aria-expanded="false">Галерея</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            {!! $component_generator->imageLoad('main_image', 'Основное изображение', isset($product['main_image']) ? $product->present()->mainImage : '') !!}
                            {{--@if(config('webmagic.ecommerce.file_use'))--}}
                                {{--<div class="form-group" data-original-title="" title="">--}}
                                    {{--@if(isset($product['file']) && $product['file']!='')--}}
                                        {{--<span class="btn btn-success pull-left products-btn" title="" style="margin-top: 0;" data-original-title="{!! $product['file'] !!}" aria-describedby="tooltip836980"><i class="fa fa-file-picture-o" data-original-title="" title=""> {!! $product['file'] !!}</i></span><div class="tooltip fade top" role="tooltip" id="tooltip836980" style="top: 281px; left: 29.4167px; display: block;"><div class="tooltip-arrow" style="left: 50%;"></div><div class="tooltip-inner">{!! $product['file'] !!}</div></div>--}}
                                        {{--<a href="{{$product->present()->fileLink()}}" class="btn btn-success pull-right products-btn download-file" title="" style="margin-top: 0; margin-left: 20px;" data-original-title="Скачать файл"><i class="fa fa-download" data-original-title="" title=""> </i> Скачать</a>--}}
                                        {{--<label for="file" class="btn btn-info pull-right" data-original-title="" title="">Изменить</label>--}}
                                        {{--<input name="file_update" type="hidden" data-original-title="" title="">--}}
                                        {{--<input class="hidden" name="file" type="file" id="file" data-original-title="" title="">--}}
                                    {{--@else--}}
                                        {{--<span class="btn btn-success pull-left products-btn" title="" style="margin-top: 0;" data-original-title="{!! $product['file'] !!}" aria-describedby="tooltip836980"><i class="fa fa-file-picture-o" data-original-title="" title=""> {!! $product['file'] !!}</i></span><div class="tooltip fade top" role="tooltip" id="tooltip836980" style="top: 281px; left: 29.4167px; display: block;"><div class="tooltip-arrow" style="left: 50%;"></div><div class="tooltip-inner">{!! $product['file'] !!}</div></div>--}}
                                        {{--<label for="file" class="btn btn-info pull-right" data-original-title="" title="">Изменить</label>--}}
                                        {{--<input name="file_update" type="hidden" data-original-title="" title="">--}}
                                        {{--<input class="hidden" name="file" type="file" id="file" data-original-title="" title="">--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--@endif--}}

                        </div>
                        <div class="col-lg-8 col-md-6 col-xs-12">
                            <a href="{{url('dashboard/ecommerce/product/' . $product['id'] . '/copy')}}" class="products-edit btn btn-xm btn-info pull-right "><i
                                        class="fa fa-copy "></i> Копировать</a>
                            {!! $component_generator->checkbox('active', 'Статус', null, isset($product['active']) ? $product['active'] : '', ['class' => 'js-switch', 'data-secondary'=>"#dd4b39"]) !!}

                            {!! $component_generator->text('name', null, 'Название') !!}
                            {!! $component_generator->text('slug', null, 'url') !!}
                            {!! $component_generator->text('article', null, 'Артикул') !!}
                            {!! $component_generator->select('category_id', $categories, null, 'Основая категория') !!}
                            @if (config('webmagic.ecommerce.additional_category_use'))
                                <div class="form-group">
                                    <label for="additional-categories">Дополнительные категории</label>
                                    <select id="additional-categories" name="additional_categories"
                                            class="js-select2 col-md-12" multiple="multiple">
                                        @foreach($categories as $id => $name)
                                            <option value="{{$id}}"
                                                    @if(isset($product['additionalCategories'][$id])) selected="selected" @endif>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="box box-solid box-default ">
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    {!! $component_generator->text('price', null, 'Цена') !!}
                                    {!! $form_builder->label('', null) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    {!! $component_generator->textareaWYSIHTML5('short_description', null, 'Краткое описание') !!}
                    {!! $component_generator->textareaWYSIHTML5('description', null, 'Описание') !!}
                    {!! $component_generator->text('meta_title', null, 'Мета заголовок') !!}
                    {!! $component_generator->text('meta_description', null, 'Мета описание') !!}
                    {!! $component_generator->text('meta_keywords', null, 'Ключевые слова') !!}
                </div>
                @if(config('webmagic.ecommerce.filter_use'))
                <div class="tab-pane" id="tab_3">
                    @if(isset($filter['name']))
                        <h4>Фильтр: {{$filter['name']}}</h4>
                        @foreach($filter['options'] as $option_group_name => $options)
                            <div class="form-group">
                                <label>{{$option_group_name}}</label>
                                <select class="form-control" name="options[]">
                                    <option value=""></option>
                                    @foreach($options as $option)
                                        <option value="{{$option['option_id']}}"
                                                @if(isset($product['options'][$option['option_id']]))selected="selected"@endif>{{$option['option_value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    @else
                        Фильтр не задан. Выберите категориию и установите в ней фильтр
                    @endif
                </div>
                @endif
                <div class="tab-pane" id="tab_4">
                    {!! $component_generator->imageLoad('images', 'Галерея', isset($product['images']) ? $product->present()->gallery : '', ['multiple' => '']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
</div>