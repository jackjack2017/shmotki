<?php

namespace Webmagic\Request;

use Illuminate\Routing\Router;


class RequestDashboardServiceProvider extends RequestServiceProvider
{

    /**
     * Register Request services
     */
    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(
            __DIR__.'/config/request_dashboard.php', 'webmagic.dashboard.request'
        );

    }

    /**
     * Register routes
     *
     * @param Router $router
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        //Routs registering
        include 'Http/routes_dashboard.php';


        //Config publishing
        $this->publishes([
            __DIR__.'/config/request_dashboard.php' => config_path('webmagic/dashboard/request.php'),
        ], 'config');

        //Views publishing
        $this->publishes([
            __DIR__.'/resources/views/' => base_path('resources/views/vendor/request/'),
        ], 'views');

        //Add dashboard menu item
        $dashboard_menu_items = view()->shared('menu');
        $parent_category = config('webmagic.dashboard.request.menu_parent_category');
        $menu_item_config = config('webmagic.dashboard.request.dashboard_menu_item');
        $menu_item_name = config('webmagic.dashboard.request.menu_item_name');
        if($parent_category !== ''){
            $dashboard_menu_items[$parent_category]['sub_items'][$menu_item_name] = $menu_item_config;
        } else {
            $dashboard_menu_items[$menu_item_name] = $menu_item_config;
        }

        view()->share('menu', $dashboard_menu_items);
    }

}