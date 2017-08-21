<?php


namespace Webmagic\Users;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //Service registering
        $this->app->singleton('UserService', function($app){
            return new UserService();
        });

        $this->mergeConfigFrom(
            __DIR__.'/config/users.php', 'webmagic.users'
        );

    }

    /**
     * @param Router $router
     */
    public function boot(Router $router)
    {
        include 'Http/routes.php';

        //Migrations publishing
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('/migrations'),
        ], 'migrations');

        //Config publishing
        $this->publishes([
            __DIR__.'/config/users.php' => config_path('webmagic/users.php'),
        ], 'config');

        //Seeds publishing
        $this->publishes([
            __DIR__.'/database/seeds/' => database_path('/seeds'),
        ], 'seeds');

        $this->registeringMiddleware($router);
    }

    /**
     * Middleware registration
     *
     * @param $router
     */
    public function registeringMiddleware($router)
    {
        $router->middlewareGroup('users', [
            \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        ]);
    }

}