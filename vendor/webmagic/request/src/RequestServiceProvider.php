<?php

namespace Webmagic\Request;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;


class RequestServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/request.php', 'webmagic.request'
        );

        //Service registering
        $this->app->singleton('RequestService', function($app){
            return new RequestService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        //Migrations publishing
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('/migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/config/request.php' => config_path('/webmagic/request.php'),
        ], 'config');

        //Load Views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'request');

        //Routs registering
        include 'Http/routes.php';

        $this->registeringMiddleware($router);
    }

    /**
     * Middleware registration
     *
     * @param $router
     */
    public function registeringMiddleware($router)
    {
        $router->middlewareGroup('request', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
        ]);
    }

}