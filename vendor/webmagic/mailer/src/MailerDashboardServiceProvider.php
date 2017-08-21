<?php

namespace Webmagic\Mailer;

use Illuminate\Routing\Router;

class MailerDashboardServiceProvider extends MailerServiceProvider
{
    /**
     * Bootstrap the application services.
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
            __DIR__.'/config/mailer_dashboard.php' => config_path('webmagic/dashboard/mailer.php')
        ], 'config');

        //Publish views
        $this->publishes([
            __DIR__.'/resources/views/' => base_path('resources/views/vendor/mailer'),
        ], 'views');

        //Add dashboard menu item
        $dashboard_menu_items = view()->shared('menu');
        $parent_category = config('webmagic.dashboard.mailer.menu_parent_category');
        $menu_item_config = config('webmagic.dashboard.mailer.dashboard_menu_item');
        $menu_item_name = config('webmagic.dashboard.mailer.menu_item_name');
        if($parent_category !== ''){
            $dashboard_menu_items[$parent_category]['sub_items'][$menu_item_name] = $menu_item_config;
        } else {
            $dashboard_menu_items[$menu_item_name] = $menu_item_config;
        }

        view()->share('menu', $dashboard_menu_items);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(
            __DIR__.'/config/mailer_dashboard.php', 'webmagic.dashboard.mailer'
        );
    }
}
