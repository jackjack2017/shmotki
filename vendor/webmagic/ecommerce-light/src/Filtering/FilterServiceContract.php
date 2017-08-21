<?php

namespace Webmagic\EcommerceLight\Filtering;


interface FilterServiceContract
{
    /**
     *
     * Filtering products by options
     *
     * @param $category_id
     * @param array $options
     * @param bool $products_per_page
     * @param bool $active_only
     *
     * @param array $brands
     * @return bool
     */
    public function getFilteredProducts($category_id, array $options, $products_per_page = false, $active_only = true, array $brands);
}