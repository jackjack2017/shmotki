<?php

namespace Webmagic\EcommerceLight\Filtering;


use Webmagic\Core\Entity\EntityRepoInterface;

interface OptionGroupContract extends EntityRepoInterface
{

    /**
     * Return option group with options
     *
     * @param int $entity_id
     *
     * @return mixed
     */
    public function getByID($entity_id);


    /**
     * Change category position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     * @return
     */
    public function moveAfter($moving_entity_id, $base_entity_id);


    /**
     * Change category position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     * @return
     */
    public function moveBefore($moving_entity_id, $base_entity_id);

}