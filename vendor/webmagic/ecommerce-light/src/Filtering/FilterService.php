<?php


namespace Webmagic\EcommerceLight\Filtering;

use Webmagic\EcommerceLight\Product\ProductRepo;

class FilterService extends ProductRepo
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
    public function getFilteredProducts($category_id, array $options, $products_per_page = false, $active_only = true, array $brands)
    {

        if(!$optionGroups = $this->prepareOptions($options)){
            return false;
        }

        $product_query = $this->addCategoryFilter(null, $category_id);

        if($brands){
            $product_query = $this->addBrandFilter($product_query, $brands);
        }
        //Filtering by options
        foreach ($optionGroups as $option_group_id => $optionGroup) {
            $table_alias = 't_' . $option_group_id;
            $product_query->join('ecom_product_option as ' . $table_alias, function ($join) use ($optionGroup, $table_alias) {
                $join->on('ecom_products.id', '=', $table_alias . '.product_id')
                    ->where(function ($query) use ($optionGroup, $table_alias) {
                        foreach ($optionGroup as $option) {
                            $query->orWhere($table_alias . '.option_id', '=', $option['id']);
                        }
                    });
            });
        }

        return $this->getProducts($product_query, $products_per_page, $active_only);

    }

    /**
     * Get info about options groups and group them by optionGroup
     *
     * @param array $options
     *
     * @return mixed
     */
    protected function prepareOptions(array $options)
    {
        return OptionGroup::join('ecom_options as o', 'o.option_group_id', '=', 'ecom_option_groups.id')
            ->whereIn('o.id', $options)
            ->select('o.id', 'o.option_group_id', 'o.color')
            ->get()
            ->groupBy('option_group_id');
    }
}