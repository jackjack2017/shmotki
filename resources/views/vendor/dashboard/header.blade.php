<header class="main-header">
    <!-- Logo -->
    <a href="{{url('dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{{config('laravel-components.dashboard.dashboard.short_title')}}</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{config('laravel-components.dashboard.dashboard.full_title')}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><b>Audi</b> Service</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{url('/')}}" target="_blank">Просмотр сайта</a>
                </li>
                <li>
                    <a href="{{url('logout')}}">Выйти</a>
                </li>
            </ul>
        </div>
    </nav>
</header>