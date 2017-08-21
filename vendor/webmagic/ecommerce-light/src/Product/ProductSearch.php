<?php

namespace Webmagic\EcommerceLight\Product;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductSearch extends ProductRepo implements ProductSearchContract
{

    /**
     * Search products by part of name
     *
     * @param null $product_name_part
     * @param null $products_per_page
     * @param bool $active_only
     *
     * @return Collection|LengthAwarePaginator
     */
    public function searchByName($product_name_part = null, $products_per_page = null, $active_only = false)
    {
        $query = $this->query();

        $query = $query->search($product_name_part, null, false, true);

        return $this->realGetMany($query, $products_per_page, $active_only);
    }


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
                                             $products_per_page = null, $active_only = false)
    {
        $query = $this->query();

        $query = $query->search($product_name_part, null, false, true);

        if(!is_null($categories_id)){
            $query = $this->addCategoryFilter($query, $categories_id);
        }

        return $this->realGetMany($query, $products_per_page, $active_only);
    }
}