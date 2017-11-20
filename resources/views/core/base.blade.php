<!DOCTYPE html>
<html lang="ru">
<head>
<!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="{{asset('css/ie.css')}}">

<![endif]-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
</head>
<body class="{{$body_class}}">
<div class="wrapper">
	<div class="cnt-wrap">
		{{--Header--}}
		@include('parts/_header')
	
		{{--Content--}}
		@section('content')
		@show
	</div>
	
	{{--Footer--}}
	@include('parts/_footer')

</div>




{{--Forms--}}
@include('parts/_forms')

<script src="{{asset('js/libs.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>

{{--Counters--}}
@if(!app()->environment('local'))
    @include('parts/_counters')
@endif
<div style="display: none;" id="_token-csrf">{{csrf_token()}}</div>
</body>
</html>