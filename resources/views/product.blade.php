@extends('core/base')
@section('content')

@include('parts/_breadcrumbs')

<div class="product">
    	<div class="product-container">
    		<div class="product-row">
    			<div class="product-img">
                    <div class="product-slider owl-carousel owl-theme js_slider-product js_gallery-product">
                        <a href="{{asset('img/product-img1.jpg')}}" class="product-slider-i">
                            <img src="{{asset('img/product-img1.jpg')}}" alt="product-img">
                        </a>
                        <a href="{{asset('img/banner-img2.jpg')}}" class="product-slider-i js_product-slider-i">
                            <img src="{{asset('img/banner-img2.jpg')}}" alt="product-img">
                        </a>
                        <a href="{{asset('img/product-img3.jpg')}}" class="product-slider- js_product-slider-i">
                            <img src="{{asset('img/product-img3.jpg')}}" alt="product-img">
                        </a>
                        <a href="{{asset('img/banner-img.jpg')}}" class="product-slider-i js_product-slider-i">
                            <img src="{{asset('img/banner-img.jpg')}}" alt="product-img">
                        </a>
                        <a href="{{asset('img/product-img2.jpg')}}" class="product-slider-i js_product-slider-i">
                            <img src="{{asset('img/product-img2.jpg')}}" alt="product-img">
                        </a>
                    </div>
                    <div class="owl-dots js_product-slider-dots-container">
                        <div class="owl-dot">
                            <img src="{{asset('img/product-img1.jpg')}}" alt="product-img">
                        </div>
                        <div class="owl-dot">
                            <img src="{{asset('img/banner-img2.jpg')}}" alt="product-img">
                        </div>
                        <div class="owl-dot">
                            <img src="{{asset('img/product-img3.jpg')}}" alt="product-img">
                        </div>
                        <div class="owl-dot">
                            <img src="{{asset('img/banner-img.jpg')}}" alt="product-img">
                        </div>
                        <div class="owl-dot">
                            <img src="{{asset('img/product-img2.jpg')}}" alt="product-img">
                        </div>
                    </div>
	    		</div>
	    		<div class="product-info">
	    			<p class="product-name">Плaтье с рисунком</p>
                    <p class="product-price">2 999 грн</p>
                    <p class="product-article">Артикул: 23456789</p>
                    <p class="product-c">Цвет:</p>
                    <div class="product-c-wrap">
                        <div class="product-c-i">
                            <input type="radio" name="color" id="color" class="product-c-inp" checked>
                            <label for="color" class="product-c-inp-lbl"></label>
                        </div>
                        <div class="product-c-i">
                            <input type="radio" name="color" id="color2" class="product-c-inp">
                            <label for="color2" class="product-c-inp-lbl" style="background-color: #c78dd4"></label>
                        </div>
                        <div class="product-c-i">
                            <input type="radio" name="color" id="color3" class="product-c-inp">
                            <label for="color3" class="product-c-inp-lbl" style="background-color: #cdad88"></label>
                        </div>
                        <div class="product-c-i">
                            <input type="radio" name="color" id="color4" class="product-c-inp">
                            <label for="color4" class="product-c-inp-lbl" style="background-color: #c76767"></label>
                        </div>
                        <div class="product-c-i">
                            <input type="radio" name="color" id="color5" class="product-c-inp">
                            <label for="color5" class="product-c-inp-lbl" style="background-color: #a5d79b"></label>
                        </div>
                    </div>
                    <p class="product-s">Размер:</p>
                    <div class="product-s-wrap">
                        <div class="product-s-i">
                            <input type="radio" name="size" id="size" class="product-s-inp" checked>
                            <label for="size" class="product-s-inp-lbl">23</label>
                        </div>
                        <div class="product-s-i">
                            <input type="radio" name="size" id="size2" class="product-s-inp" disabled>
                            <label for="size2" class="product-s-inp-lbl">98</label>
                        </div>
                        <div class="product-s-i">
                            <input type="radio" name="size" id="size3" class="product-s-inp">
                            <label for="size3" class="product-s-inp-lbl">XXL</label>
                        </div>
                        <div class="product-s-i">
                            <input type="radio" name="size" id="size4" class="product-s-inp">
                            <label for="size4" class="product-s-inp-lbl">K-150_2x</label>
                        </div>
                        <div class="product-s-i">
                            <input type="radio" name="size" id="size5" class="product-s-inp">
                            <label for="size5" class="product-s-inp-lbl">112</label>
                        </div>
                    </div>
                    <a href="#" class="product-s-lnk" target="blank">Размерная сетка</a>
                    <div class="product-btn-wrap">
                        <a href="#" class="product-btn-inverse">Добавить в корзину</a>
                    </div>
                     <div class="product-btn-wrap">
                        <a href="#" class="product-btn">В избранное</a>
                    </div>
                    <div class="product-description">
                        <div class="product-description-t">
                            <a href="#" class="product-description-lnk __active">Описание</a>
                            <a href="#" class="product-description-lnk">Подробнее</a>
                            <a href="#" class="product-description-lnk">Доставка</a>
                            <a href="#" class="product-description-lnk">Отзывы</a>
                        </div>
                        <div class="product-description-b default-cnt">
                            <p>Платье из плотного трикотажа с рельефным рисунком. На платье длинные рукава и отрезная талия. Боковые карманы.</p>
                        </div>
                    </div>
                    <div class="product-advantages">
                        <div class="product-advantages-row">
                            <div class="product-advantages-col">
                                <span class="product-advantages-ic fa fa-facebook-square fa-2x"></span>
                                <p class="product-advantages-txt"> Оплата: Заказ оплачивается наличными или кредитной/дебетовой картой при получении.</p>
                            </div>
                             <div class="product-advantages-col">
                                <span class="product-advantages-ic fa fa-shopping-cart fa-2x"></span>
                                <p class="product-advantages-txt"> Оплата: Заказ оплачивается наличными или кредитной/дебетовой картой при получении.</p>
                            </div>
                             <div class="product-advantages-col">
                                <span class="product-advantages-ic fa fa-snowflake-o fa-2x"></span>
                                <p class="product-advantages-txt"> Оплата: Заказ оплачивается наличными или кредитной/дебетовой картой при получении.</p>
                            </div>
                             <div class="product-advantages-col">
                                <span class="product-advantages-ic fa fa-balance-scale fa-2x"></span>
                                <p class="product-advantages-txt"> Оплата: Заказ оплачивается наличными или кредитной/дебетовой картой при получении.</p>
                            </div>
                        </div>
                    </div>
	    		</div>
    		</div>
            <h2 class="product-ttl">Недавно просмотренные</h2>
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
            <h2 class="product-ttl">Сочетается с</h2>
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
    	</div>
    </div>

@endsection