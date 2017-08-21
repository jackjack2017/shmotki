<?php

namespace Webmagic\EcommerceLight;

use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\ExcelServiceProvider;
use Illuminate\Routing\Router;

class EcommerceDashboardServiceProvider extends EcommerceServiceProvider
{
    /**
     * Register products service
     */
    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(
            __DIR__.'/DashboardIntegration/config/ecommerce_dashboard.php', 'webmagic.dashboard.ecommerce'
        );

        //Register provider
        App::register(ExcelServiceProvider::class);
    }

    /**
     * Boot products service
     * @param Router $router
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        //Routs registering
        $this->loadRoutesFrom(__DIR__.'/DashboardIntegration/Http/routes_dashboard.php');

        //Load Views
        $this->loadViewsFrom(__DIR__.'/DashboardIntegration/resources/views', 'ecommerce');

        //Config publishing
        $this->publishes([
            __DIR__.'/DashboardIntegration/config/ecommerce_dashboard.php' => config_path('webmagic/dashboard/ecommerce.php'),
        ], 'config');

        //Views publishing
        $this->publishes([
            __DIR__.'/DashboardIntegration/resources/views/' => base_path('resources/views/vendor/ecommerce/'),
        ], 'views');

        //Add dashboard menu item
        $dashboard_menu_items = view()->shared('menu');
        $parent_category = config('webmagic.dashboard.ecommerce.menu_parent_category');
        $menu_item_config = config('webmagic.dashboard.ecommerce.dashboard_menu_item');

        $menu_item_name = config('webmagic.dashboard.ecommerce.menu_item_name');
        if($parent_category !== ''){
            $dashboard_menu_items[$parent_category]['sub_items'][$menu_item_name] = $menu_item_config;
        } else {
            $dashboard_menu_items[$menu_item_name] = $menu_item_config;
        }

        view()->share('menu', $dashboard_menu_items);
    }

}