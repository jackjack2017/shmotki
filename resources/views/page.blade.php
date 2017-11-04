@extends('core/base')
@section('content')

@include('parts/_breadcrumbs')

<section class="page">
	<div class="page-container-main">
		<div class="page-container">
			<div class="page-sidebar">
				<ul class="page-lst default-cnt">
					<li><a href="#">
						<span>Новые поступления</span>
					</a></li>
					<li ><a href="#">
						<span>Акции</span>
					</a></li>
					<li ><a href="#">
						<span>Хиты продаж</span>
					</a></li>
					<li ><a href="#" >Куртки и пальто</a></li>
					<li ><a href="#" >Трикотаж</a></li>
					<li ><a href="#" >Кардиганы и джемперы</a></li>
					<li ><a href="#" >Рубашки и брюки</a></li>
					<li ><a href="#" >Топы</a></li>
					<li ><a href="#" >Базовые модели</a></li>
					<li ><a href="#" >Платья</a></li>
					<li ><a href="#">Пиджаки и жилеты</a></li>
					<li ><a href="#" >Брюки</a></li>
					<li ><a href="#">Джинсы</a></li>
					<li ><a href="#" >Комбинезоны</a></li>
					<li ><a href="#" >Юбки</a></li>
					<li ><a href="#" >Обувь</a></li>
					<li ><a href="#" >Аксессуары</a></li>
					<li><a href="#" >Белье</a></li>
					<li ><a href="#" >Одежда для сна</a></li>
					<li ><a href="#" >Носки и колготки</a></li>
					<li ><a href="#" >Шорты</a></li>
					<li ><a href="#" >Купальники</a></li>
					<li ><a href="#" >Спортивная одежда</a></li>
					<li ><a href="#" >Одежда для беременных</a></li>
					<li ><a href="#">Большие размеры</a></li>
				</ul>
			</div>
			<div class="page-cnt">
				<div class="page-banner">
					<img src="{{asset('img/banner-img.jpg')}}" alt="banner">
					<div class="page-banner-txt">
						<h2 class="page-banner-ttl">Новая коллекция</h2>
						<h2 class="page-banner-ttl-L">Акционное предложение</h2>
						<div class="page-banner-btn-wrap">
							<a href="#" class="page-banner-btn">Купить сейчас</a>
						</div>
					</div>
				</div>
				<div class="page-banner __left">
					<img src="{{asset('img/banner-img2.jpg')}}" alt="banner">
					<div class="page-banner-txt">
						<h2 class="page-banner-ttl">Новая коллекция</h2>
						<h2 class="page-banner-ttl-L">Хит продаж</h2>
						<div class="page-banner-btn-wrap">
							<a href="#" class="page-banner-btn-inverse">Купить сейчас</a>
						</div>
					</div>
				</div>
				<h2 class="page-ttl">Новые поступления</h2>
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
			</div>
		</div>
	</div>
</section>

@endsection