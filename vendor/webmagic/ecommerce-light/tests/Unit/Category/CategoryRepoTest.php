<?php

use Tests\TestCase;
use Tests\Unit\Category\CategoryRepo;
use Webmagic\EcommerceLight\Category\Category;
use IvanLemeshev\Laravel5CyrillicSlug\Slug;


class CategoryRepoTest extends TestCase
{

    /** @var  CategoryRepo */
    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new CategoryRepo();
        $this->repo->setEntity(Category::class);
    }


    public function testCreate()
    {
        $slug = new Slug();

        //Create parent category
        $parent_category_name = 'parent category name';
        $parent_category_slug = $slug->make($parent_category_name, '-');
        $this->repo->create([
            'name' => $parent_category_name,
            'parent_id' => 0,
        ]);

        $parent_category = $this->repo->getByID('1');

        //Create subcategory
        $category_name = 'category name';
        $category_slug = $slug->make($category_name, '-');
        $this->repo->create([
            'name' => $category_name,
            'parent_id' => $parent_category->id,
        ]);

        $category = $this->repo->getByID('2');

        $this->assertTrue(is_subclass_of($parent_category, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($parent_category_name, $parent_category->name);
        $this->assertEquals($parent_category_slug, $parent_category->slug);

        $this->assertTrue(is_subclass_of($category, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($category_name, $category->name);
        $this->assertEquals($category_slug, $category->slug);
        $this->assertEquals($parent_category->id, $category->parent_id);
    }

    public function testUpdate()
    {
        //create and update parent category
        $parent_category_new_name = 'new parent category name';

        $slug = new Slug();
        $parent_category_slug = $slug->make($parent_category_new_name, '-');

        $parent_category =  factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create();
        $this->repo->update($parent_category->id, ['name' => $parent_category_new_name]);
        $updated_parent_category = Category::find($parent_category->id);


        //create and update first sub category
        $first_sub_cat_new_name = 'new subcategory name';
        $first_sub_category_slug = $slug->make($first_sub_cat_new_name, '-');

        $first_sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $parent_category->id
        ]);

        $this->repo->update($first_sub_category->id, ['name' => $first_sub_cat_new_name]);
        $updated_first_sub_category = Category::find($first_sub_category->id);


        //create and update second sub category
        $second_sub_cat_new_name = 'new second subcategory name';
        $second_sub_category_slug = $slug->make($second_sub_cat_new_name, '-');

        $second_sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $parent_category->id
        ]);
        $this->repo->update($second_sub_category->id, ['name' => $second_sub_cat_new_name]);
        $updated_second_sub_category = Category::find($second_sub_category->id);


        //Check if parent category is equal to new entity
        $this->assertEquals($updated_parent_category->name,  $parent_category_new_name);
        $this->assertEquals($updated_parent_category->slug, $parent_category_slug);

        //Check if first sub category is equal to new entity
        $this->assertEquals($updated_first_sub_category->name, $first_sub_cat_new_name);
        $this->assertEquals($updated_first_sub_category->slug, $first_sub_category_slug);
        $this->assertEquals($updated_first_sub_category->parent_id, $parent_category->id);

        //Check if second sub category is equal to new entity
        $this->assertEquals($updated_second_sub_category->name, $second_sub_cat_new_name);
        $this->assertEquals($updated_second_sub_category->slug, $second_sub_category_slug);
        $this->assertEquals($updated_second_sub_category->parent_id, $parent_category->id);
    }

    public function testGetTree()
    {
        $categories_tree = $this->repo->getTree();

        //Checking instance of empty tree
        $this->assertTrue($categories_tree instanceof \Kalnoy\Nestedset\Collection);
        $this->assertCount(0, $categories_tree);

        //Creating categories and products
        $create_parent_category =  factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create();
        $create_first_sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $create_parent_category->id
        ]);
        $create_second_sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $create_first_sub_category->id
        ]);

        $product =  factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'category_id' => $create_second_sub_category->id
        ]);


        //Checking tree with products
        $categories_tree = $this->repo->getTree();
        $parent_category = $categories_tree->first();
        $first_sub_category = $parent_category->children->first();
        $second_sub_category = $first_sub_category->children->first();

        //Check parent category
        $this->assertTrue($categories_tree instanceof \Kalnoy\Nestedset\Collection);
        $this->assertEquals($create_parent_category->name, $parent_category->name);

        //check if parent category has products(no)
        $this->assertTrue($parent_category->products instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals(0, count($parent_category->products));

        //Parent category doesn't have parents
        $this->assertNull($parent_category->parent);

        //Parent category has one sub category
        $this->assertTrue($parent_category->children instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals(1, count($parent_category->children));

        //Check first sub category
        $this->assertEquals($create_first_sub_category->name, $first_sub_category->name);
        $this->assertTrue(is_subclass_of($first_sub_category->parent, \Illuminate\Database\Eloquent\Model::class));

        //Check if first sub category has products(no)
        $this->assertTrue($parent_category->products instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals(0, count($parent_category->products));
        //First sub category has one sub category

        $this->assertTrue($first_sub_category->children instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals(1, count($parent_category->children));

        //Check second sub category
        $this->assertEquals($create_second_sub_category->name, $second_sub_category->name);
        $this->assertTrue(is_subclass_of($second_sub_category->parent, \Illuminate\Database\Eloquent\Model::class));

        //Check if first sub category has products(yes)
        $this->assertTrue($second_sub_category->products instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals(1, count($second_sub_category->products));
        $this->assertEquals($product->name, $second_sub_category->products->first()->name);

        //Second sub category has no one sub category
        $this->assertTrue($second_sub_category->children instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals(0, count($second_sub_category->children));
        $this->assertArrayHasKey('products', $second_sub_category->toArray());

        //Checking tree without products
        $categories_tree = $this->repo->getTree(false);
        $parent_category = $categories_tree->first();
        $first_sub_category = $parent_category->children->first();
        $second_sub_category = $first_sub_category->children->first();

        $this->assertArrayNotHasKey('products', $second_sub_category->toArray());
    }

    public function testGetAllChildren()
    {
        $parent_category =  factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create();

        $parent_category_node = $this->repo->getByID($parent_category->id);
        $categories = $this->repo->getAllChildren($parent_category_node);

        //Checking instance of empty children tree
        $this->assertTrue($categories instanceof \Kalnoy\Nestedset\Collection);
        $this->assertEquals(0, count($categories));


        $first_sub_category_data = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $parent_category->id
        ]);

        $second_sub_category_data = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $parent_category->id
        ]);


        //Add products for sub categories
        factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'category_id' => $first_sub_category_data->id,
        ]);
        factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'category_id' => $second_sub_category_data->id,
        ]);

        $parent_category_node = $this->repo->getByID($parent_category->id);

        //Categories with products
        $categories = $this->repo->getAllChildren($parent_category_node);

        $this->assertTrue($categories instanceof \Kalnoy\Nestedset\Collection);
        $this->assertEquals(2, count($categories));
        $this->assertArrayHasKey('products', $categories[0]);
        $this->assertArrayHasKey('products', $categories[1]);

        //Categories without products
        $categories = $this->repo->getAllChildren($parent_category_node, false);

        $this->assertTrue($categories instanceof \Kalnoy\Nestedset\Collection);
        $this->assertEquals(2, count($categories));
        $this->assertArrayNotHasKey('products', $categories[0]->toArray());
        $this->assertArrayNotHasKey('products', $categories[1]->toArray());
    }

    public function testGetParents()
    {
        //No parents
        $category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create();

        $category_node = $this->repo->getByID($category->id);
        $parents = $this->repo->getParents($category_node);

        $this->assertTrue($parents instanceof \Kalnoy\Nestedset\Collection);
        $this->assertEquals(0, count($parents));

        //One level parents without products
        $sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $category->id
        ]);

        $sub_category_node = $this->repo->getByID($sub_category->id);
        $parents = $this->repo->getParents($sub_category_node, false);

        $this->assertTrue($parents instanceof \Kalnoy\Nestedset\Collection);
        $this->assertEquals(1, count($parents));
        $this->assertArrayNotHasKey('products', $parents[0]->toArray());

        //Two level parents without products
        $sub_sub_category =factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $sub_category->id
        ]);

        $sub_sub_category_node = $this->repo->getByID($sub_sub_category->id);
        $parents = $this->repo->getParents($sub_sub_category_node, false);

        $this->assertTrue($parents instanceof \Kalnoy\Nestedset\Collection);
        $this->assertEquals(2, count($parents));
        $this->assertArrayNotHasKey('products', $parents[0]->toArray());


        //With products
        $product =  factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'category_id' => $sub_category->id
        ]);
        $parents = $this->repo->getParents($sub_sub_category_node);

        $this->assertArrayHasKey('products', $parents[0]->toArray());
        $this->assertEquals(0, count($parents[0]['products']));
        $this->assertArrayHasKey('products', $parents[1]->toArray());
        $this->assertEquals(1, count($parents[1]['products']));
        $this->assertEquals($product->name, $parents[1]['products']->first()->name);
    }

    public function testGetAll()
    {
        $categories_collection = $this->repo->getAll();

        //Check instance in no one category
        $this->assertTrue($categories_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $categories_collection);

        //Creating categories
        $parent_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create();
        factory(\Webmagic\EcommerceLight\Category\Category::class, 2)->create([
            'parent_id' => $parent_category->id
        ]);
        //Creating product
        factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'category_id' => $parent_category->id
        ]);


        //Without products
        $categories_collection = $this->repo->getAll(false);

        $this->assertTrue($categories_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(3, $categories_collection);
        $this->assertArrayNotHasKey('products', $categories_collection->first()->toArray());

        //With products
        $categories_collection = $this->repo->getAll();

        $this->assertTrue($categories_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertArrayHasKey('products', $categories_collection->first()->toArray());
        $this->assertEquals(1, count($categories_collection->first()['products']));
    }

    public function testGetAllActive()
    {
        $first_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create(['active' => false]);
        $second_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create(['active' => false]);

        factory(\Webmagic\EcommerceLight\Product\Product::class)->create([
            'category_id' => $first_category->id
        ]);

        //Check there is no one active category
        $categories_collection = $this->repo->getAllActive();

        $this->assertTrue($categories_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(0, $categories_collection);


        $this->repo->update($first_category->id, [
            'name' => $first_category->name,
            'active' => true,
        ]);

        //Without products
        $categories_collection = $this->repo->getAllActive(false);

        $this->assertTrue($categories_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(1, $categories_collection);

        //Without products
        $categories_collection = $this->repo->getAllActive();

        $this->assertTrue($categories_collection instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals($first_category->name, $categories_collection->first()->name);
        $this->assertArrayHasKey('products', $categories_collection->first()->toArray());
        $this->assertEquals(1, count($categories_collection->first()['products']));
    }

    public function testGetById()
    {
        $category_name = 'category name';
        $new_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create(['name' => $category_name]);

        factory(\Webmagic\EcommerceLight\Product\Product::class, 2)->create([
            'category_id' => $new_category->id
        ]);

        //Without products
        $category = $this->repo->getByID($new_category->id, false);

        $this->assertTrue(is_subclass_of($category, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($category_name, $category->name);
        $this->assertArrayNotHasKey('products', $category->toArray());

        //With products
        $category = $this->repo->getByID($new_category->id);

        $this->assertTrue(is_subclass_of($category, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($category_name, $category->name);
        $this->assertArrayHasKey('products', $category);
        $this->assertEquals(2, count($category->products));

    }

    public function testGetBySlug()
    {
        $category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();
        factory(\Webmagic\EcommerceLight\Product\Product::class, 2)->create([
            'category_id' => $category->id
        ]);

        //Without products
        $category = $this->repo->getBySlug($category->slug, false);

        $this->assertTrue(is_subclass_of($category, \Illuminate\Database\Eloquent\Model::class));
        $this->assertArrayNotHasKey('products', $category->toArray());

        //With products
        $category = $this->repo->getBySlug($category->slug);

        $this->assertTrue(is_subclass_of($category, \Illuminate\Database\Eloquent\Model::class));
        $this->assertArrayHasKey('products', $category);
        $this->assertEquals(2, count($category->products));
    }

    public function testGetForMenu()
    {
        $menu_array = $this->repo->getForMenu();
        //Checking empty array
        $this->assertInternalType('array', $menu_array);
        $this->assertCount(0, $menu_array);

        $parent_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')->create(['active' => true]);
        $first_sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $parent_category->id,
            'active' => true
        ]);
        $second_sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $parent_category->id,
            'active' => true
        ]);
        $third_sub_category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create([
            'parent_id' => $parent_category->id,
            'active' => false
        ]);

        $menu_array = $this->repo->getForMenu();

        $this->assertInternalType('array', $menu_array);
        $this->assertCount(1, $menu_array);
        $this->assertEquals($parent_category->name, $menu_array[$parent_category->id]['category']['name']);
        $this->assertCount(2, $menu_array[$parent_category->id]['sub-categories']);
        $this->assertEquals($first_sub_category->name,  $menu_array[$parent_category->id]['sub-categories'][0]['name']);
        $this->assertEquals($second_sub_category->name, $menu_array[$parent_category->id]['sub-categories'][1]['name']);
    }

    public function testSearchByName()
    {
        $first_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')
            ->create(['name' => 'first category']);
        $second_category = factory(\Webmagic\EcommerceLight\Category\Category::class, 'main')
            ->create(['name' => 'second category']);

        //Search by not exist name
        $result = $this->repo->searchByName('test');

        $this->assertTrue($result instanceof \Kalnoy\Nestedset\Collection);
        $this->assertCount(0, $result);

        //Search by full name
        $result = $this->repo->searchByName($first_category->name);

        $this->assertTrue($result instanceof \Kalnoy\Nestedset\Collection);
        $this->assertCount(1, $result);
        $this->assertEquals($first_category->name, $result->first()->name);

        //Search by part of name
        $result = $this->repo->searchByName('category');

        $this->assertTrue($result instanceof \Kalnoy\Nestedset\Collection);
        $this->assertCount(2, $result);
        $this->assertEquals($first_category->name, $result[0]->name);
        $this->assertEquals($second_category->name, $result[1]->name);
    }
}