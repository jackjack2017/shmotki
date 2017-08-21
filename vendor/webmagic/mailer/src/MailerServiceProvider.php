<?php

namespace Webmagic\Mailer;


use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;


class MailerServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register()
    {
        $this->app->singleton('MailerRepo', function($app){
            return new MailerRepo();
        });

        $this->mergeConfigFrom(
            __DIR__.'/config/mailer.php', 'webmagic.mailer'
        );

        $this->registerProviders();
    }


    /**
     * Bootstrapping services
     */
    public function boot(Router $router)
    {
        //Config publishing
        $this->publishes([
            __DIR__.'/config/mailer.php' => config_path('webmagic/mailer.php')
        ], 'config');

        //Migrations publishing
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('/migrations'),
        ], 'migrations');

        //Seeds publishing
        $this->publishes([
            __DIR__.'/database/seeds/' => database_path('/seeds'),
        ], 'seeds');

        //Publish views
        $this->publishes([
            __DIR__ . '/resources/views/emails/' => base_path('resources/views/vendor/mailer/emails'),
        ], 'views');

        //Load Views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'mailer');

        $this->registeringMiddleware($router);
    }

    /**
     * Register providers
     */
    protected function registerProviders(){
        $this->app->register('\Webmagic\Mailer\MailerEventServiceProvider');
    }



    /**
     * Middleware registration
     *
     * @param $router
     */
    public function registeringMiddleware($router)
    {
        $router->middlewareGroup('mailer', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
        ]);
    }
}