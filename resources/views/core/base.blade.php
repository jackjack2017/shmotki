<!DOCTYPE html>
<html lang="ru">
<head>
<!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="{{asset('css/ie.css')}}">

<![endif]-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
</head>
<body class="{{$body_class}}">

{{--Header--}}
@include('parts/_header')

{{--Content--}}
@section('content')
@show

{{--Footer--}}
@include('parts/_footer')

{{--Forms--}}
@include('parts/_forms')

<script src="{{asset('js/libs.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>

{{--Counters--}}
@if(!app()->environment('local'))
    @include('parts/_counters')
@endif
<div style="display: none;">{{csrf_token()}}</div>
</body>
</html>