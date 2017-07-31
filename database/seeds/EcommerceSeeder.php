<?php

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EcomCategoriesTableSeeder::class);
        $this->call(EcomProductsTableSeeder::class);
    }
}
