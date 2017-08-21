<?php


namespace Webmagic\EcommerceLight\Product;


use Illuminate\Pagination\LengthAwarePaginator;
use Webmagic\Core\Entity\EntityRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepoContract extends EntityRepoInterface
{
    /**
     * Return product by ID
     *
     * @param      $slug
     *
     * @return Product
     */
    public function getBySlug($slug);


    /**
     * Return product by Id
     *
     * @param $id
     *
     * @return Product|null
     */
    public function getById($id);


    /**
     * Return all products
     *
     * @param null $products_per_page
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAll($products_per_page = null);


    /**
     * Return all active products
     * Check product status and product category status
     *
     * @param null $products_per_page
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAllActive($products_per_page = null);

    /**
     * Return products filtered by currency ID
     *
     * @param      $category_id
     * @param int $products_per_page
     * @param bool $active_only
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getByCategoryID($category_id, $products_per_page = null, $active_only = false);



    /**
     * Return products filtered by categories
     *
     * @param array $categories_id
     * @param null $products_per_page
     * @param bool $active_only
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getByCategories($categories_id = null, $products_per_page = null, $active_only = false);



    /**
     * Return data about products (count, count of active, ect)
     *
     * @return bool|array
     */
    public function getData();



    /**
     * Return all products grouped by category
     *
     * @return Collection
     */
    public function getAllWithCategoryGrouping();


    /**
     * Change product status
     *
     * @param $product_id
     * @param $new_status
     *
     * @return bool
     */
    public function changeStatus($product_id, $new_status);


    /**
     * Change product position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     */
    public function moveAfter($moving_entity_id, $base_entity_id);


    /**
     * Change product position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     * @return
     */
    public function moveBefore($moving_entity_id, $base_entity_id);


    /**
     * Add filtering by part of product name
     *
     * @param Builder|null $product_query
     * @param null         $product_name_part
     *
     * @return Builder
     */
    public function addNameFilter(Builder $product_query = null, $product_name_part = null);


    /**
     * @param array $product_data
     *
     * @return Product
     */
    public function create(array $product_data);


    /**
     * Conversion currency and save all changes in product
     *
     * @param $product_id
     * @param $product_data
     *
     * @return int
     */
    public function update($product_id, array $product_data);
}