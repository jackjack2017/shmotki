<?php


namespace Webmagic\EcommerceLight\Filtering;


use Webmagic\Core\Entity\EntityRepoInterface;

interface FilterRepoContract extends EntityRepoInterface
{
    /**
     * Return filter prepared for check
     *
     * @param $filter_id
     *
     * @return mixed
     */
    public function getForConfig($filter_id);

    /**
     * Return filter for config product
     *
     * @param $product_id
     *
     * @return bool|mixed
     */
    public function getForProductConfig($product_id);

    /**
     * Return filter without not need options for category
     *
     * Remove options if category have no products with them
     * Remove options if category have products with them by products are no active
     *
     * @param $filter_id
     * @param $category_id
     *
     * @return mixed
     */
    public function getForCategory($filter_id, $category_id);
}