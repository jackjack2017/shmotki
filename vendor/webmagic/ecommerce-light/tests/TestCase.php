<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Console\Kernel;
use Webmagic\Dashboard\DashboardServiceProvider;
use Webmagic\EcommerceLight\EcommerceDashboardServiceProvider;

class TestCase extends BaseTestCase
{
    /**
     * Boots the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();


        $app->register(DashboardServiceProvider::class);
        $app->register(EcommerceDashboardServiceProvider::class);

        return $app;
    }

    /**
     * Setup DB before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate', ['--path' => '../../../tests/migrations']);
    }



}