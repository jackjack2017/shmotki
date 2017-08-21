<?php


namespace Webmagic\EcommerceLight\Filtering;


use Webmagic\Core\Entity\EntityRepo;

class OptionRepo extends EntityRepo
{

    /**
     * Use for getting current entity
     *
     */
    protected $entity = Option::class;

    /**
     * Change product position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     */
    public function moveAfter($moving_entity_id, $base_entity_id)
    {
        $option = $this->query()->find($moving_entity_id);
        $option->moveAfter($this->query()->find($base_entity_id));
    }


    /**
     * Change product position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     */
    public function moveBefore($moving_entity_id, $base_entity_id)
    {
        $option = $this->query()->find($moving_entity_id);
        $option->moveBefore($this->query()->find($base_entity_id));
    }
}