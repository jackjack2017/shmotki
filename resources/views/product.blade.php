@extends('core/base')
@section('content')
<div class="product">
    	<div class="product-container">
    		<div class="product-row">
    			<div class="product-img">
    				<div class="product-img-l">
    					<img src="{{asset('img/product-img1.jpg')}}" alt="product-img">
    					<img src="{{asset('img/product-img2.jpg')}}" alt="product-img">
    					<img src="{{asset('img/product-img3.jpg')}}" alt="product-img">
    				</div>
    				<div class="product-img-r">
    					<img src="{{asset('img/product-img4.jpg')}}" alt="product-img">
    				</div>
	    		</div>
	    		<div class="product-info">
	    			
	    		</div>
    		</div>
    	</div>
    </div>

@endsection