<?php

namespace Webmagic\Dashboard;


use Collective\Html\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Webmagic\Dashboard\Generators\ComponentGenerator;
use Roumen\Asset\Asset;
use Illuminate\Support\Facades\App;
use Illuminate\Routing\Router;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     * @param FormBuilder $form_builder
     * @param ComponentGenerator $componentGenerator
     * @param Router $router
     */
    public function boot(Request $request, FormBuilder $form_builder, ComponentGenerator $componentGenerator, Router $router)
    {
        //Routs registering
        include 'Http/routes.php';

        //Config publishing
        $this->publishes([
            __DIR__.'/config/dashboard.php' => config_path('webmagic/dashboard/dashboard.php'),
        ], 'config');

        //Publish assets and other
        $this->publishes([
            __DIR__.'/public/' => public_path('webmagic/dashboard'),
        ], 'public');

        //Views publishing
        $this->publishes([
            __DIR__.'/resources/views/' => base_path('resources/views/vendor/dashboard/'),
        ], 'views');

        //Load Views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'dashboard');

        //Menu control init
        view()->share('menu_control', [
            'category' => '',
            'page' => '',
            'tab' => ''
        ]);

        /* Prepare class for body */
        if($request->path() === '/'){
            $body_class = 'page-index';
        } else {
            $body_class = 'page-' . str_replace('/', '-', $request->path());
        }
        view()->share('body_class', $body_class);

        //Dashboard menu init
        view()->share('menu', config('webmagic.dashboard.dashboard.menu'));


        //Registering resources
        $this->register();
        $this->registeringMiddleware($router);

        //Init assets manager
        $asset = new Asset();
        $asset->add('webmagic/dashboard/css/style.css');
        $asset->add('webmagic/dashboard/js/script.js');
//        $asset->add('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js');
        view()->share('asset', $asset);


        //Old functionality that will be removed in future
        $this->willBeRemoved($form_builder, $componentGenerator);
    }


    protected function willBeRemoved(FormBuilder $form_builder, ComponentGenerator $componentGenerator)
    {
        //Share form_builder for all modules
        view()->share('form_builder', $form_builder);
        view()->share('component_generator', $componentGenerator);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/dashboard.php', 'webmagic.dashboard.dashboard'
        );

        //Registering resources
        $this->registerServiceProviders();
        $this->registerCommands();


        // Registering Dashboard functionality
        $this->app->singleton('Dashboard', function(){
            return new Dashboard();
        });
    }


    /**
     * Register commands
     */
    public function registerCommands()
    {
        $this->commands([
            Console\Commands\Publish::class
        ]);
    }

    /**
     * Register service providers
     */
    public function registerServiceProviders()
    {
        App::register('\Roumen\Asset\AssetServiceProvider');
        App::register('\Collective\Html\HtmlServiceProvider');
        //Register Users module
        App::register('\Webmagic\Users\UserDashboardServiceProvider');
    }


    /**
     * Middleware registration
     *
     * @param $router
     */
    public function registeringMiddleware($router)
    {
        $router->middlewareGroup('dashboard', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
        ]);
    }
}