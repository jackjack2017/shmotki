<?php

use Illuminate\Database\Seeder;

class EcomCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Webmagic\EcommerceLight\Category\Category::class, 'main', 2)->create();
        factory(\Webmagic\EcommerceLight\Category\Category::class, 3)->create([
            'parent_id' => 1
        ]);
        factory(\Webmagic\EcommerceLight\Category\Category::class, 1)->create([
            'parent_id' => 2
        ]);
    }
}
