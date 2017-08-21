<?php


namespace Webmagic\EcommerceLight\Product;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductSearchContract extends ProductRepoContract
{

    /**
     * Search products by part of name
     *
     * @param string $product_name_part
     * @param null $products_per_page
     * @param bool $active_only
     *
     * @return Collection|LengthAwarePaginator
     */
    public function searchByName($product_name_part = null, $products_per_page = null, $active_only = false);


    /**
     * Search products by name with possibility use brands and categories correction
     *
     * @param null $product_name_part
     * @param null $categories_id
     * @param null $products_per_page
     * @param bool $active_only
     *
     * @return Collection|LengthAwarePaginator
     */
    public function searchByNameInCategories($product_name_part = null, $categories_id = null,
                                             $products_per_page = null, $active_only = false);



}