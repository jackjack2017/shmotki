<?php

namespace Webmagic\Users;

use Illuminate\Routing\Router;

class UserDashboardServiceProvider extends UserServiceProvider
{
    /**
     * Register User dashboard services provider
     */
    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(
            __DIR__.'/config/users_dashboard.php', 'webmagic.dashboard.users'
        );
    }

    /**
     * Register User dashboard routes
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        include 'Http/routes_dashboard.php';

        //Load Views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'users');

        //Config publishing
        $this->publishes([
            __DIR__.'/config/users_dashboard.php' => config_path('webmagic/dashboard/users.php'),
        ], 'config');

        //Views publishing
        $this->publishes([
            __DIR__.'/resources/views' => base_path('/resources/views/vendor/users/'),
        ], 'config');

        //Add dashboard menu item
        $dashboard_menu_items = view()->shared('menu');

        $parent_category = config('webmagic.dashboard.users.menu_parent_category');
        $menu_item_config = config('webmagic.dashboard.users.dashboard_menu_item');
        $menu_item_name = config('webmagic.dashboard.users.menu_item_name');
        if($parent_category !== ''){
            $dashboard_menu_items[$parent_category]['sub_items'][$menu_item_name] = $menu_item_config;
        } else {
            $dashboard_menu_items[$menu_item_name] = $menu_item_config;
        }

        view()->share('menu', $dashboard_menu_items);
    }

}