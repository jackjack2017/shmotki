<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->bodyClassShare();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->changePublicPath();
        $this->registerServices();
    }

    /**
     * Prepare and share body class
     */
    protected function bodyClassShare()
    {
        $request = request();

        if($request->path() === '/'){
            $body_class = 'page-index';
        } else {
            $body_class = 'page-' . str_replace('/', '-', $request->path());
        }

        view()->share('body_class', $body_class);
    }

    /**
     * Registering app services
     */
    public function registerServices()
    {
        /**
         * Conditionally Loading Service Providers
         *
         * local - load all tech service providers
         * dev-server - load iseed and migrate generator service providers
         */
        if($this->app->environment('local')){
            $this->app->register('Themsaid\MailPreview\MailPreviewServiceProvider');
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }

        if($this->app->environment('local') || $this->app->environment('dev-server')){
            $this->app->register('Way\Generators\GeneratorsServiceProvider');
            $this->app->register('Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider');
            $this->app->register('Orangehill\Iseed\IseedServiceProvider');
        }
    }

    /**
     * Change public path to public_html
     */
    protected function changePublicPath()
    {
        $this->app->bind('path.public', function() {
            return base_path('public_html');
        });
    }
}
