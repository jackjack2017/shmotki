<?php


namespace Webmagic\EcommerceLight\Filtering;


use Webmagic\Core\Entity\EntityRepo;

class OptionGroupRepo extends EntityRepo
{

    /**
     * Use for getting current entity
     *
     */
    protected $entity = OptionGroup::class;

    /**
     * Return option group with options
     *
     * @param int $entity_id
     *
     * @return mixed
     */
    public function getByID($entity_id)
    {
        $query = $this->query();
        $query->where('id', $entity_id)->with('options');

        return $this->realGetOne($query);
    }

    /**
     * Change category position
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
     * Change category position
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