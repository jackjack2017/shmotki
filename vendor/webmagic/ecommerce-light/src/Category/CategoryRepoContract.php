<?php


namespace Webmagic\EcommerceLight\Category;


use Illuminate\Database\Eloquent\Collection;
use Webmagic\Core\Entity\EntityRepoInterface;

interface CategoryRepoContract extends EntityRepoInterface
{

    /**
     * Get all categories with multilevel
     *
     * @param bool $with_products
     *
     * @return Collection|mixed
     */
    public function getTree($with_products = true): Collection;


    /**
     * Create category with parents relations
     *
     * @param array $category_data
     *
     * @return bool|mixed
     */
    public function create(array $category_data);


    /**
     * Update entity by ID
     *
     * @param int|string $entity_id
     * @param array $category_data
     *
     * @return int
     */
    public function update($entity_id, array $category_data);


    /**
     * Return all descendants of category
     *
     * @param Category $category
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getAllChildren(Category $category, $with_products = true): Collection;


    /**
     * Return collection of all parents
     *
     * @param Category $category
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getParents(Category $category,  $with_products = true): Collection;


    /**
     * Return all categories
     *
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getAll($with_products = true): Collection;


    /**
     * Return all active categories
     *
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getAllActive($with_products = true): Collection;


    /**
     * Find category by id
     *
     * @param int $id
     * @param bool $with_products
     *
     * @return Category
     */
    public function getByID($id, $with_products = true);


    /**
     * Return category by slug
     *
     * @param string $slug
     * @param bool $with_products
     *
     * @return Category
     */
    public function getBySlug(string $slug, $with_products = true);


    /**
     * Return categories prepared for menu
     *
     * @return array
     */
    public function getForMenu(): array;


    /**
     * Change category position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     *
     * @return
     */
    public function moveAfter($moving_entity_id, $base_entity_id);


    /**
     * Change category position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     *
     * @return
     */
    public function moveBefore($moving_entity_id, $base_entity_id);


    /**
     * Search by name or by part of name
     *
     * @param string $category_name_part
     *
     * @return Collection
     */
    public function  searchByName(string $category_name_part);

}