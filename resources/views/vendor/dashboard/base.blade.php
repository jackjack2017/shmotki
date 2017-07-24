<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script>
        csrf_token = '{{csrf_token()}}';
    </script>
    <title>@yield('meta-title', config('laravel-components.dashboard.dashboard.full_title'))</title>
    {{-- Add css --}}
    {{ $asset->css() }}

</head>
<body class="hold-transition skin-blue sidebar-mini {{$body_class}}">
<div class="wrapper">

    {{--Header--}}
    @include('dashboard::header')

   {{--Sidebar--}}
    @include('dashboard::sidebar')

   {{--Content--}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            <h1>@yield('title', '')</h1>
        </div>
        <div class="content">
            @include('dashboard::alert')
            @yield('content')
        </div>
    </div>
    <!-- /.content-wrapper -->

    {{--Footer--}}
    @include('dashboard::footer')
    {{--END Footer--}}

            <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

{{--Modals--}}
@include('dashboard::modals')
{{--END Modals--}}
</body>
{{-- Add js --}}
{{$asset->js()}}
</html>
