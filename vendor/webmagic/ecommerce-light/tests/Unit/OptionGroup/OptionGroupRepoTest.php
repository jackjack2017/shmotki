<?php

namespace Tests\Unit\OptionGroup;

use Tests\TestCase;
use Webmagic\EcommerceLight\Filtering\Option;
use Webmagic\EcommerceLight\Filtering\OptionGroup;

class OptionGroupRepoTest extends TestCase
{

    /** @var  OptionGroupRepo */
    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new OptionGroupRepo();
        $this->repo->setEntity(OptionGroup::class);
    }

    public function testGetByIdWithOptions()
    {
        $option_group = factory(\Webmagic\EcommerceLight\Filtering\OptionGroup::class)->create();

        factory(\Webmagic\EcommerceLight\Filtering\Option::class, 2)->create(
            ['option_group_id' => $option_group->id]
        );

        $option_groups = $this->repo->getById($option_group->id);

        $this->assertTrue(is_subclass_of($option_groups, \Illuminate\Database\Eloquent\Model::class));
        $this->assertTrue($option_groups->options instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertCount(2, $option_groups->options);
    }
}