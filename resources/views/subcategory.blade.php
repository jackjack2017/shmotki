@extends('core/base')
@section('content')

@include('parts/_breadcrumbs')


<section class="subcategory">
	<div class="subcategory-container-main">
		<div class="subcategory-container">
			<div class="subcategory-sidebar">
				<p class="subcategory-sidebar-txt">Тип платья:</p>
				<p class="subcategory-sidebar-txt">Цена:</p>
				<p class="subcategory-sidebar-txt">Размер:</p>
				<p class="subcategory-sidebar-txt">Сезон:</p>
				<p class="subcategory-sidebar-txt">Материал:</p>
				<p class="subcategory-sidebar-txt">Цвет:</p>
			</div>
			<div class="subcategory-cnt">
				<h2 class="subcategory-ttl-L">Платья</h2>
				<div class="subcategory-cnt-filter">
					<p class="subcategory-cnt-filter-txt">Сортировать по:</p>
					<a href="#" class="subcategory-cnt-filter-lnk">Популярные</a>
					<a href="#" class="subcategory-cnt-filter-lnk">По возрастанию</a>
					<a href="#" class="subcategory-cnt-filter-lnk">По убыванию</a>
					<a href="#" class="subcategory-cnt-filter-lnk">Новинки</a>
					<a href="#" class="subcategory-cnt-filter-lnk">Со скидкой</a>
				</div>
				<div class="subcategory-cnt-filter">
					<p class="subcategory-cnt-filter-txt">Показывать по:</p>
					<a href="#" class="subcategory-cnt-filter-lnk __active">12</a>
					<a href="#" class="subcategory-cnt-filter-lnk">24</a>
					<a href="#" class="subcategory-cnt-filter-lnk">36</a>
				</div>
				<div class="subcategory-row">
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
					<div class="subcategory-col">
						@include('parts/_product-card')
					</div>
				</div>
				
				<div class="subcategory-btn-show-wrap">
					<a href="#" class="subcategory-btn-show">Показать еще</a>
				</div>
				

				@include('parts/_pagination')

				<h2 class="subcategory-ttl">Недавно просмотренные</h2>
				<div class="category-slider  js_slider-main owl-carousel owl-theme">
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
					<div class="category-slider-i">
						@include('parts/_product-card')
					</div>
				</div>
				<h2 class="subcategory-ttl-L">Платья</h2>
				<div class="default-cnt">
					<p>Составляйте стильные ансамбли с белоснежными рубашками, прозрачными блузками и легкими туниками. Чтобы создать всегда актуальный и безупречный образ, который легко преобразить, сочетайте любимые изделия с подходящими аксессуарами.</p>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection