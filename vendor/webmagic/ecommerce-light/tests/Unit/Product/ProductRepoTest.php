<?php

use Tests\TestCase;
use Tests\Unit\Product\ProductRepo;
use Webmagic\EcommerceLight\Product\Product;
use IvanLemeshev\Laravel5CyrillicSlug\Slug;
use Webmagic\EcommerceLight\Filtering\Option;

class ProductRepoTest extends TestCase
{

    /** @var  ProductRepo */
    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new ProductRepo();
        $this->repo->setEntity(Product::class);
    }


    public function testCreate()
    {
        $slug = new Slug();

        $product_name = 'product name';
        $product_slug = $slug->make($product_name, '-');

        //main category
        $first_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')
            ->create(['name' => 'first category']);
        //additional category
        $second_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')
            ->create(['name' => 'second category']);
        $third_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')
            ->create(['name' => 'third category']);

        //options
        $first_option = factory(\Webmagic\EcommerceLight\Filtering\Option::class)->create();
        $second_option = factory(\Webmagic\EcommerceLight\Filtering\Option::class)->create();

        $new_product = $this->repo->create([
            'name' => $product_name,
            'category_id' => $first_category->id,
            'additional_categories' => [$second_category->id, $third_category->id],
            'options' => [$first_option->id, $second_option->id]
        ]);

        $product = $this->repo->getById($new_product->id);

        $this->assertTrue(is_subclass_of($product, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($product_name, $product->name);
        $this->assertEquals($product_slug, $product->slug);

        //Check main category and relations with additional categories
        $this->assertEquals($first_category->name, $product->category);
        $this->assertTrue($product->additionalCategories instanceof \Kalnoy\Nestedset\Collection);
        $this->assertCount(2, $product->additionalCategories);

        //Check relations with options
        $this->assertTrue($product->options instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(2, $product->options);
    }

    public function testGetBySlug()
    {
        $slug = new Slug();
        $product_name = 'product name';
        $product_slug = $slug->make($product_name, '-');

        $first_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'name' => $product_name,
            'slug' => $product_slug
        ]);
        $second_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create();

        $product = $this->repo->getBySlug($product_slug);

        $this->assertTrue(is_subclass_of($product, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($product_name, $first_product->name);
    }

    public function testGetById()
    {
        $product_name = 'product name';

        $first_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'name' => $product_name,
        ]);
        $second_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create();

        $product = $this->repo->getById($first_product->id);

        $this->assertTrue(is_subclass_of($product, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($product_name, $first_product->name);
    }

    public function testGetAll()
    {
        $products_per_page = 2;

        //Without pagination check instance of empty collection
        $products_collection = $this->repo->getAll();

        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $products_collection);

        //With pagination check instance of empty collection
        $products_collection = $this->repo->getAll($products_per_page);

        $this->assertTrue($products_collection instanceof \Illuminate\Pagination\LengthAwarePaginator);
        $this->assertCount(0, $products_collection);

        factory(\Webmagic\EcommerceLight\Product\Product::class, 3)->create();

        //Without pagination
        $products_collection = $this->repo->getAll();

        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(3, $products_collection);

        //With pagination
        $products_collection = $this->repo->getAll($products_per_page);

        $this->assertTrue($products_collection instanceof \Illuminate\Pagination\LengthAwarePaginator);
        $this->assertCount(2, $products_collection->items());
        $this->assertEquals(3, $products_collection->total());
        $this->assertEquals($products_per_page, $products_collection->perPage());
    }

    public function testGetAllActive()
    {
        $products_per_page = 1;
        $qty_active_products = 2;
        $qty_not_active_products = 1;

        //Without pagination
        $products_collection = $this->repo->getAllActive();
        //Check instance of empty colelction
        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $products_collection);

        //With pagination
        $products_collection = $this->repo->getAll($products_per_page);

        $this->assertTrue($products_collection instanceof \Illuminate\Pagination\LengthAwarePaginator);
        $this->assertCount(0, $products_collection);

        //Create not active product
        factory(\Webmagic\EcommerceLight\Product\Product::class, $qty_not_active_products)->create(['active' => false]);
        //Create active product
        factory(\Webmagic\EcommerceLight\Product\Product::class, $qty_active_products)->create(['active' => true]);

        //Without pagination
        $products_collection = $this->repo->getAllActive();

        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount($qty_active_products, $products_collection);

        //With pagination
        $products_collection = $this->repo->getAllActive($products_per_page);

        $this->assertTrue($products_collection instanceof \Illuminate\Pagination\LengthAwarePaginator);
        $this->assertCount($qty_not_active_products, $products_collection->items());
        $this->assertEquals($qty_active_products, $products_collection->total());
        $this->assertEquals($products_per_page, $products_collection->perPage());
    }

    public function testGetByCategoryId()
    {
        $products_per_page = 2;
        $category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();

        //Check instance of empty collection
        $products_collection = $this->repo->getByCategoryID($category->id);
        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $products_collection);

        //Creating products
        $first_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create();
        $second_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'active' => false,
            'category_id' => $category->id
        ]);
        $third_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'active' => true,
            'category_id' => $category->id
        ]);


        //Without products but only active
        $products_collection = $this->repo->getByCategoryID($category->id, null, true);

        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(1, $products_collection);
        $this->assertEquals(1, $products_collection->first()->active);
        $this->assertEquals($third_product->id, $products_collection->first()->id);

        //With products
        $products_collection = $this->repo->getByCategoryID($category->id, $products_per_page);

        $this->assertTrue($products_collection instanceof \Illuminate\Pagination\LengthAwarePaginator);
        $this->assertCount(2, $products_collection->items());
        $this->assertEquals($products_per_page, $products_collection->perPage());
    }

    public function testGetByCategories()
    {
        $first_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();
        $second_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();
        $products_per_page = 2;

        $products_collection = $this->repo->getByCategories([$first_category->id, $second_category->id]);

        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $products_collection);

        //Creating different product
        $first_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'active' => false,
            'category_id' => $first_category->id
        ]);
        $second_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'active' => false,
            'category_id' => $second_category->id,
        ])->each(function ($product) use ($first_category){
            $product->additionalCategories()->sync($first_category->id);
        });;

        $third_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'active' => true,
            'category_id' => $second_category->id,
        ]);


        //Without pagination
        $products_collection = $this->repo->getByCategories([$first_product->id], null);

        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(2, $products_collection);

        //Without pagination but only active
        $products_collection = $this->repo->getByCategories([$second_category->id], null, true);

        $this->assertTrue($products_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(1, $products_collection);
        $this->assertEquals($third_product->id, $products_collection->first()->id);

        //without pagination
        $products_collection = $this->repo->getByCategories([$first_product->id, $second_category->id], $products_per_page);

        $this->assertTrue($products_collection instanceof \Illuminate\Pagination\LengthAwarePaginator);
        $this->assertCount($products_per_page, $products_collection->items());
        $this->assertEquals(3, $products_collection->total());
    }

    public function testSearchByName()
    {
        $first_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'name' => 'first product',
            'active' => true,
        ]);

        $second_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'name' => 'second product',
            'active' => false,
        ]);

        $third_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([]);

        $products_per_page = 2;

        //Search by not exist name
        $result = $this->repo->searchByName('test');

        $this->assertTrue($result instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $result);

        //Search by full name
        $result = $this->repo->searchByName($first_product->name);

        $this->assertTrue($result instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(1, $result);
        $this->assertEquals($first_product->name, $result->first()->name);

        //Search by part of name
        $result = $this->repo->searchByName('product');

        $this->assertTrue($result instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(2, $result);
        $this->assertEquals($first_product->name, $result[0]->name);
        $this->assertEquals($second_product->name, $result[1]->name);

        //Search by part of name with paginate and only active
        $result = $this->repo->searchByName('product', $products_per_page, true);

        $this->assertTrue($result instanceof \Illuminate\Pagination\LengthAwarePaginator);
        $this->assertEquals(1, $result->total());
        $this->assertEquals($first_product->id, $result->items()[0]['id']);
    }

    public function testSearchByNameInCategories()
    {
        $first_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();
        $second_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();;

        $first_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'name' => 'first product',
            'active' => true,
            'category_id' => $first_category->id
        ]);
        $second_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'name' => 'second product',
            'category_id' => $second_category->id
        ]);

        $third_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'category_id' => $second_category->id,
        ]);

        //Search by not exist name
        $result = $this->repo->searchByNameInCategories('test', [$first_category->id, $second_category->id]);

        $this->assertTrue($result instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $result);

        //Search by full name
        $result = $this->repo->searchByNameInCategories($first_product->name, [$first_category->id, $second_category->id]);

        $this->assertTrue($result instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(1, $result);
        $this->assertEquals($first_product->name, $result->first()->name);

    }

    public function testUpdate()
    {
        $first_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();
        $second_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();

        $first_option = factory(\Webmagic\EcommerceLight\Filtering\Option::class)->create();
        $second_option = factory(\Webmagic\EcommerceLight\Filtering\Option::class)->create();

        $old_add_cat = [$first_category->id];
        $old_options = [$first_option->id];

        $test_data = [
            'old' => [
                'name' => 'test name',
                'description' => 'test_description',
            ],
            'new' => [
                'name' => 'changed name',
                'description' => 'changed_description',
                'additional_categories' => [$first_category->id, $second_category->id],
                'options' => [$first_option->id, $second_option->id]
            ]
        ];
        $slug = new Slug();
        $product_slug = $slug->make($test_data['new']['name'], '-');

        $product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create($test_data['old']);
        $product->each(function ($product) use($old_add_cat, $old_options) {
                $product->additionalCategories()->sync($old_add_cat);
                $product->options()->sync($old_options);
            });


        $this->repo->update($product->id, $test_data['new']);

        $product = Product::find($product->id);

        //Check if it is equal to new entity
        $this->assertEquals($product->name, $test_data['new']['name']);
        $this->assertEquals($product->description, $test_data['new']['description']);
        $this->assertEquals($product->slug, $product_slug);

        //Check relations with additional categories
        $this->assertTrue($product->additionalCategories instanceof \Kalnoy\Nestedset\Collection);
        $this->assertCount(2, $product->additionalCategories);

        //Check relations with options
        $this->assertTrue($product->options instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(2, $product->options);
    }

    public function testDestroy()
    {
        $option = factory(\Webmagic\EcommerceLight\Filtering\Option::class)->create();
        $category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();

        //Creating product
        $first_product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'name' => 'test'
        ]);
        $first_product->each(function ($product) use($option, $category) {
            $product->additionalCategories()->sync($category);
            $product->options()->sync($option);
        });


        $this->repo->destroy($first_product->id);

        //Test delete with one id
        $destroyed_entity = Product::find($first_product->id);
        $this->assertNull($destroyed_entity);

        $this->assertDatabaseMissing('ecom_product_option', [
            'product_id' => $first_product->id,
            'option' => $option->id
        ]);

        $this->assertDatabaseMissing('ecom_product_category', [
            'product_id' => $first_product->id,
            'category_id' => $category->id
        ]);
    }

    public function testDestroyAll()
    {
        factory(\Webmagic\EcommerceLight\Product\Product::class, 2)->create();

        //Test that all products was deleted
        $products_exists = Product::all();
        $this->assertCount(2, $products_exists);

        $this->repo->destroyAll();
        $no_products = Product::all();
        $this->assertCount(0, $no_products);
    }

    public function testGetAllWithCategoryGrouping()
    {
        $first_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();
        $second_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();

        $qty_prod_first_cat = 2;
        $qty_prod_second_cat = 1;
        factory(\Webmagic\EcommerceLight\Product\Product::class, $qty_prod_first_cat)->create([
            'category_id' => $first_category->id
        ]);
        factory(\Webmagic\EcommerceLight\Product\Product::class, $qty_prod_second_cat)->create([
            'category_id' => $second_category->id
        ]);


        $collection = $this->repo->getAllWithCategoryGrouping();
        $keys = $collection->keys();//categories id are keys in collection

        $this->assertTrue($collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount($qty_prod_first_cat, $collection);
        $this->assertEquals($keys[0], $first_category->id);
        $this->assertEquals($keys[1], $second_category->id);
        $this->assertTrue($collection->first() instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount($qty_prod_first_cat, $collection->first());
    }
}