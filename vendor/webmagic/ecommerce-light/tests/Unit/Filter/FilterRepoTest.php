<?php

namespace Tests\Unit\Filter;

use Tests\TestCase;
use Webmagic\EcommerceLight\Filtering\Filter;
use Webmagic\EcommerceLight\Filtering\Option;
use Webmagic\EcommerceLight\Filtering\OptionGroup;

class FilterRepoTest extends TestCase
{
    /** @var  FilterRepo */
    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new FilterRepo();
        $this->repo->setEntity(Filter::class);
    }

    public function testCreate()
    {
        $first_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();
        $second_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();

        $filter_name = 'filter test';
        $new_filter = $this->repo->create([
            'name' => $filter_name,
            'option_groups' => [$first_group->id, $second_group->id]
        ]);

        $filter = Filter::find($new_filter->id)->with('optionGroups')->first();

        $this->assertTrue(is_subclass_of($filter, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($filter_name, $filter->name);
        $this->assertTrue($filter->optionGroups instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(2, $filter->optionGroups);
    }

    public function testUpdate()
    {
        $first_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();
        $second_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();

        $test_data = [
            'old' => [
                'name' => 'test_name',
                'option_groups' => [$first_group->id]
            ],
            'new' => [
                'name' => 'changed_name',
                'option_groups' => [$second_group->id]
            ]
        ];

        $test_entity = $this->repo->create($test_data['old']);

        $this->repo->update($test_entity->id, $test_data['new']);

        $filter = Filter::find($test_entity->id)->with('optionGroups')->first();

        $this->assertEquals($filter->name, $test_data['new']['name']);
        $this->assertEquals($filter->optionGroups->first()->id, $test_data['new']['option_groups'][0]);
    }

    public function testDestroy()
    {
        $option_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();

        $first_filter = $this->repo->create([
            'name' => 'test name1',
            'option_groups' => $option_group->id
        ]);

        $second_filter = $this->repo->create([
            'name' => 'test name2',
            'option_groups' => $option_group->id
        ]);

        $this->repo->destroy($first_filter->id);

        //Test delete with one id
        $destroyed_entity = Filter::find($first_filter->id);
        $this->assertNull($destroyed_entity);
        $this->assertDatabaseMissing('ecom_filter_option_group', [
            'filter_id' => $first_filter->id,
            'option_group_id' => $option_group->id
        ]);
        $third_entity = Filter::find($second_filter->id);
        $this->assertNotNull($third_entity);
        $this->assertDatabaseHas('ecom_filter_option_group', [
            'filter_id' => $second_filter->id,
            'option_group_id' => $option_group->id
        ]);
    }


    public function testGetById()
    {
        $first_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();
        $second_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();

        $first_filter = $this->repo->create([
            'name' => 'first filter',
            'option_groups' => [$first_group->id, $second_group->id]
        ]);

        factory(\Webmagic\EcommerceLight\Filtering\Filter::class)->create(
            ['name' => 'second filter']
        );

        $filter = $this->repo->getByID($first_filter->id);

        $this->assertTrue(is_subclass_of($filter, \Illuminate\Database\Eloquent\Model::class));
        $this->assertEquals($first_filter->name, $filter->name);
        $this->assertTrue($filter->optionGroups instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(2, $filter->optionGroups);
    }
}