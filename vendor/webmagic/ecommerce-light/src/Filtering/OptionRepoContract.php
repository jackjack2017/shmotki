<?php


namespace Webmagic\EcommerceLight\Filtering;


use Webmagic\Core\Entity\EntityRepoInterface;

interface OptionRepoContract extends EntityRepoInterface
{
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