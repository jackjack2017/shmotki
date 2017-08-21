<?php

namespace Tests\Unit\Category;

use Webmagic\EcommerceLight\Category\CategoryRepo as BaseRepo;

class CategoryRepo extends BaseRepo
{
    public function setEntity($entity_name)
    {
        $this->entity = $entity_name;
    }
}