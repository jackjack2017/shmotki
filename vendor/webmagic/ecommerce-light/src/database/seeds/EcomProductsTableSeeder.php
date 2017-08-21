<?php

use Illuminate\Database\Seeder;
use Webmagic\EcommerceLight\Category\Category;

class EcomProductsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nth_products_in_category = 10;

        foreach(Category::all() as $category)
        {
            for($i=0; $i < $nth_products_in_category; $i++)
            {
                factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
                    'category_id' => $category['id']
                ]);
            }
        }
    }
}
