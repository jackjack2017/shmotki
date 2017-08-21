<?php

namespace Tests\Unit\Filter;

use Webmagic\EcommerceLight\Filtering\FilterRepo as BaseRepo;

class FilterRepo extends BaseRepo
{
    public function setEntity($entity_name)
    {
        $this->entity = $entity_name;
    }
}