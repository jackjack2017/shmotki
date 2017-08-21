<?php

namespace Tests\Unit\OptionGroup;

use Webmagic\EcommerceLight\Filtering\OptionGroupRepo as BaseRepo;

class OptionGroupRepo extends BaseRepo
{
    public function setEntity($entity_name)
    {
        $this->entity = $entity_name;
    }
}