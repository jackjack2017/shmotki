 <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                @foreach($menu as $menu_item_name => $menu_item)
                    @if(isset($menu_item['permissions']) && (!$menu_item['permissions'] || !auth()->user()->hasPermission($menu_item['permissions'])))
                        <li class="@if($menu_control['page'] === $menu_item_name || $menu_control['category'] === $menu_item_name) active @endif
                                @if($menu_item['category']) treeview @endif ">
                            <a href="{{url($menu_item['url'])}}">
                                <i class="fa {{$menu_item['icon_class']}}"></i><span>{{$menu_item['label']}}</span>
                                @if($menu_item['category'])<i class="fa fa-angle-left pull-right"></i>@endif
                            </a>
                            @if($menu_item['category'])
                                <ul class="treeview-menu">
                                    @foreach($menu_item['sub_items'] as $sub_item_name => $sub_item)
                                        @if(!$sub_item['permissions'] || !auth()->user()->hasPermission($sub_item['permissions']))
                                            <li class="@if($menu_control['page'] == $sub_item_name) active @endif">
                                                <a href="{{url($sub_item['url'])}}">
                                                    <i class="fa {{$sub_item['icon_class']}}"></i><span>{{$sub_item['label']}}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>