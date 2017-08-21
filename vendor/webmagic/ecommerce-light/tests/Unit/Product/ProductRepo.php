<?php

namespace Tests\Unit\Product;

use Webmagic\EcommerceLight\Product\ProductExporter as BaseRepo;

class ProductRepo extends BaseRepo
{
    public function setEntity($entity_name)
    {
        $this->entity = $entity_name;
    }
}