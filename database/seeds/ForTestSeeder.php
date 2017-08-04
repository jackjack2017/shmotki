<?php


use Illuminate\Database\Eloquent\Factory;

class ForTestSeeder extends EcommerceSeeder
{
    /**
     * Manually load factories
     */
    public function run()
    {
        $factory = app(Factory::class);
        include __DIR__ . '/../factories/ModelFactory.php';

        parent::run();
    }

}