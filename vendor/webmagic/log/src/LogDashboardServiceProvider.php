<?php

namespace Webmagic\Log;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LogDashboardServiceProvider extends ServiceProvider
{
    /**
     * Register log services
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/log_dashboard.php', 'webmagic.dashboard.log'
        );

        $this->registerServiceProviders();
    }

    /**
     * Register routes
     * @param Router $router
     */
    public function boot(Router $router)
    {
        //Routs registering
        include 'Http/routes.php';

        //Load Views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'log');

        //Config publishing
        $this->publishes([
            __DIR__.'/config/log_dashboard.php' => config_path('webmagic/dashboard/log.php'),
        ], 'config');


        //Add dashboard menu item
        $dashboard_menu_items = view()->shared('menu');
        $parent_category = config('webmagic.dashboard.log.menu_parent_category');
        $menu_item_config = config('webmagic.dashboard.log.dashboard_menu_item');
        $menu_item_name = config('webmagic.dashboard.log.menu_item_name');

        if($parent_category !== ''){
            $dashboard_menu_items[$parent_category]['sub_items'][$menu_item_name] = $menu_item_config;
        } else {
            $dashboard_menu_items[$menu_item_name] = $menu_item_config;
        }

        view()->share('menu', $dashboard_menu_items);

        $this->registeringMiddleware($router);
    }


    /**
     * Register service providers
     */
    public function registerServiceProviders()
    {
        App::register('Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider');
    }


    /**
     * Middleware registration
     *
     * @param $router
     */
    public function registeringMiddleware($router)
    {
        $router->middlewareGroup('log', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
        ]);
    }
}