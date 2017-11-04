@extends('core/base')
@section('content')

@include('parts/_breadcrumbs')


<section class="category">
	<div class="category-container-main">
		<div class="category-container">
			<div class="category-sidebar">
				<p class="category-sidebar-txt">Тип платья:</p>
				<div class="checkbox-wrap">
                    <input id="subcategoryKind1" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryKind1" class="checkbox-lbl">Мини</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategoryKind2" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryKind2" class="checkbox-lbl">Макси</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategoryKind3" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryKind3" class="checkbox-lbl">Миди</label>
                </div>
				<p class="category-sidebar-txt">Цена:</p>
				<div class="checkbox-wrap">
                    <input id="subcategoryPrice1" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryPrice1" class="checkbox-lbl">Мини</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategoryPrice2" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryPrice2" class="checkbox-lbl">Макси</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategoryPrice3" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryPrice3" class="checkbox-lbl">Миди</label>
                </div>
				<p class="category-sidebar-txt">Размер:</p>
				<div class="checkbox-wrap">
                    <input id="subcategorySize1" class="checkbox-inp" type="checkbox">            
                    <label for="subcategorySize1" class="checkbox-lbl">Мини</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategorySize2" class="checkbox-inp" type="checkbox">            
                    <label for="subcategorySize2" class="checkbox-lbl">Макси</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategorySize3" class="checkbox-inp" type="checkbox">            
                    <label for="subcategorySize3" class="checkbox-lbl">Миди</label>
                </div>
				<p class="category-sidebar-txt">Сезон:</p>
				<div class="checkbox-wrap">
                    <input id="subcategorySeason1" class="checkbox-inp" type="checkbox">            
                    <label for="subcategorySeason1" class="checkbox-lbl">Мини</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategorySeason2" class="checkbox-inp" type="checkbox">            
                    <label for="subcategorySeason2" class="checkbox-lbl">Макси</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategorySeason3" class="checkbox-inp" type="checkbox">            
                    <label for="subcategorySeason3" class="checkbox-lbl">Миди</label>
                </div>
				<p class="category-sidebar-txt">Материал:</p>
				<div class="checkbox-wrap">
                    <input id="subcategoryMaterial1" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryMaterial1" class="checkbox-lbl">Мини</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategoryMaterial2" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryMaterial2" class="checkbox-lbl">Макси</label>
                </div>
                <div class="checkbox-wrap">
                    <input id="subcategoryMaterial3" class="checkbox-inp" type="checkbox">            
                    <label for="subcategoryMaterial3" class="checkbox-lbl">Миди</label>
                </div>
				<p class="category-sidebar-txt">Цвет:</p>
				<div class="category-c-wrap">
                        <div class="category-c-i">
                            <input type="checkbox" name="color" id="subcategoryColor" class="category-c-inp">
                            <label for="subcategoryColor" class="category-c-inp-lbl"></label>
                        </div>
                        <div class="category-c-i">
                            <input type="checkbox" name="color" id="subcategoryColor2" class="category-c-inp">
                            <label for="subcategoryColor2" class="category-c-inp-lbl" style="background-color: #c78dd4"></label>
                        </div>
                        <div class="category-c-i">
                            <input type="checkbox" name="color" id="subcategoryColor3" class="category-c-inp">
                            <label for="subcategoryColor3" class="category-c-inp-lbl" style="background-color: #cdad88"></label>
                        </div>
                        <div class="category-c-i">
                            <input type="checkbox" name="color" id="subcategoryColor4" class="category-c-inp">
                            <label for="subcategoryColor4" class="category-c-inp-lbl" style="background-color: #c76767"></label>
                        </div>
                        <div class="category-c-i">
                            <input type="checkbox" name="color" id="subcategoryColor5" class="category-c-inp">
                            <label for="subcategoryColor5" class="category-c-inp-lbl" style="background-color: #a5d79b"></label>
                        </div>
                </div>
                <div class="category-btn-inverse-wrap">
                	<a href="#" class="category-btn-inverse">Отфильтровать</a>
                </div>
			</div>
			<div class="category-cnt">
				<h2 class="category-ttl-L">Платья</h2>
				<div class="category-cnt-filter">
					<p class="category-cnt-filter-txt">Сортировать по:</p>
					<a href="#" class="category-cnt-filter-lnk">Популярные</a>
					<a href="#" class="category-cnt-filter-lnk">По возрастанию</a>
					<a href="#" class="category-cnt-filter-lnk">По убыванию</a>
					<a href="#" class="category-cnt-filter-lnk">Новинки</a>
					<a href="#" class="category-cnt-filter-lnk">Со скидкой</a>
				</div>
				<div class="category-cnt-filter">
					<p class="category-cnt-filter-txt">Показывать по:</p>
					<a href="#" class="category-cnt-filter-lnk __active">12</a>
					<a href="#" class="category-cnt-filter-lnk">24</a>
					<a href="#" class="category-cnt-filter-lnk">36</a>
					<a href="#" class="category-cnt-filter-lnk">Все</a>
				</div>
				<div class="category-row">
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
					<div class="category-col">
						@include('parts/_product-card')
					</div>
				</div>
				
				<div class="category-btn-show-wrap">
					<a href="#" class="category-btn-show">Показать еще</a>
				</div>
				

				@include('parts/_pagination')

				<h2 class="category-ttl">Недавно просмотренные</h2>
				<div class="page-slider  js_slider-main owl-carousel owl-theme">
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="page-slider-i">
						@include('parts/_product-card')
					</div>
				</div>
				<h2 class="category-ttl-L">Платья</h2>
				<div class="default-cnt">
					<p>Составляйте стильные ансамбли с белоснежными рубашками, прозрачными блузками и легкими туниками. Чтобы создать всегда актуальный и безупречный образ, который легко преобразить, сочетайте любимые изделия с подходящими аксессуарами.</p>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection