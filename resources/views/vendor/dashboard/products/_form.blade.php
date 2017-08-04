<div class="form-group">
    <label for="article" class="control-label">Артикул</label>
    {!! Form::text('article', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="name" class="control-label">Имя</label>
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="color" class="control-label">Цвет</label>
    {!! Form::text('color', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="price" class="control-label">Цена</label>
    {!! Form::text('price', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="category" class="control-label">Категория</label>
    <select name="category" id="category" class="form-control">
        <option value="life_style">Live style</option>
        <option value="kids">Детские акксессуары</option>
        <option value="cars">Модели Автомобилей</option>
    </select>
</div>
<div class="form-group">
    <label for="colection" class="control-label">Коллекция</label>
    {!! Form::text('colection', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="short_description" class="control-label">Краткое описание</label>
    {!! Form::text('short_description', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label>Описание</label>
    {!! Form::textarea('description', null, ['class'=>'form-control js-editor']) !!}
</div>
{{--<div class="form-group">--}}
    {{--<label>Главное изображение товара</label>--}}
    {{--<input type="file" id="main_image" class="js-input-preview" multiple="true">--}}
    {{--<div class="media-preview">--}}
        {{--<ul class="media-preview-l">--}}
            {{--<li class="media-preview-i">--}}
                {{--<img src="/img/{!! $product['main_image'] !!}" alt="">--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
    {{--<label>Галлерея товара</label>--}}
    {{--<input type="file" id="images" class="js-input-preview" multiple="true">--}}
    {{--<div class="media-preview">--}}
        {{--<ul class="media-preview-l">--}}
            {{--@foreach($product['images'] as $image)--}}
            {{--<li class="media-preview-i">--}}
                {{--<img src="/img/{!! $image !!}" alt="">--}}
            {{--</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>

