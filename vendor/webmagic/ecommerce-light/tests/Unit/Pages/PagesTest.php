<?php

namespace Tests\Unit\Pages;


use Tests\TestCase;
use Webmagic\Users\Models\User;


class PagesTest extends TestCase
{
    /**
     * Product
     */
    //Page for product creating
    public function testProductCreate()
    {
        $user = new User();
        $response = $this->actingAs($user)->get(route('product::create'));
        $response->assertStatus(200);
    }

    //Page for product updating
    public function testProductUpdate()
    {
        $user = new User();
        $product = factory(\Webmagic\EcommerceLight\Product\Product::class)->create();

        $response = $this->actingAs($user)->get(route('product::edit', $product->id));
        $response->assertStatus(200);
    }

    /**
     * Category
     */
    //Page for category list
    public function testCategoryIndex()
    {
        $user = new User();
        $response = $this->actingAs($user)->get(route('category::index'));
        $response->assertStatus(200);
    }

    //Page for category creating
    public function testCategoryCreate()
    {
        $user = new User();
        $response = $this->actingAs($user)->get(route('category::create'));
        $response->assertStatus(200);
    }

    //Page for category updating
    public function testCategoryUpdate()
    {
        $user = new User();
        $category = factory(\Webmagic\EcommerceLight\Category\Category::class)->create();

        $response = $this->actingAs($user)->get(route('category::edit', $category->id));
        $response->assertStatus(200);
    }

    /**
     * Filter
     */
    //Page for filter list
    public function testFilterIndex()
    {
        $user = new User();
        $response = $this->actingAs($user)->get(route('filter::index'));
        $response->assertStatus(200);
    }

    //Page for filter creating
    public function testFilterCreate()
    {
        $user = new User();
        $response = $this->actingAs($user)->get(route('filter::create'));
        $response->assertStatus(200);
    }

    //Page for filter updating
    public function testFilterUpdate()
    {
        $user = new User();
        $filter = factory(\Webmagic\EcommerceLight\Filtering\Filter::class)->create();

        $response = $this->actingAs($user)->get(route('filter::edit', $filter->id));
        $response->assertStatus(200);
    }

    /**
     * OptionGroup
     */
    //Page for optionGroup list
    public function testOptionGroupIndex()
    {
        $user = new User();
        $response = $this->actingAs($user)->get(route('filter::option_group.index'));
        $response->assertStatus(200);
    }

    //Page for optionGroup creating
    public function testOptionGroupCreate()
    {
        $user = new User();
        $response = $this->actingAs($user)->get(route('filter::option_group.create'));
        $response->assertStatus(200);
    }

    //Page for optionGroup updating
    public function testOptionGroupUpdate()
    {
        $user = new User();
        $option_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();

        $response = $this->actingAs($user)->get(route('filter::option_group.edit', $option_group->id));
        $response->assertStatus(200);
    }

    /**
     * Option
     */
    //Page for option creating
    public function testOptionCreate()
    {
        $user = new User();
        $option_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();

        $response = $this->actingAs($user)->get(route('filter::option.create', $option_group->id));
        $response->assertStatus(200);
    }

    //Page for option updating
    public function testOptionUpdate()
    {
        $user = new User();
        $option = factory(\Webmagic\EcommerceLight\Filtering\Option::class)->create();

        $response = $this->actingAs($user)->get(route('filter::option.create', $option->id));
        $response->assertStatus(200);
    }
}
