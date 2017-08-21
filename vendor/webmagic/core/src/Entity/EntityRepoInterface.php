<?php

namespace Webmagic\Core\Entity;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


interface EntityRepoInterface
{
    /**
     * Get all entities
     *
     * @return Collection|Paginator
     */
    public function getAll();

    /**
     * @return Collection|Paginator
     */
    public function getAllActive();

    /**
     * Get entity by ID
     *
     * @param int|string $entity_id
     *
     * @return Model|null
     */
    public function getByID($entity_id);

    /**
     * Create new entity
     *
     * @param array $entity_data
     *
     * @return Model
     */
    public function create(array $entity_data);

    /**
     * Update entity by ID
     *
     * @param int|string $entity_id
     * @param array $entity_data
     *
     * @return int
     */
    public function update($entity_id, array $entity_data);

    /**
     * Destroy entity by ID
     *
     * @param integer|array $entity_id
     *
     * @return mixed
     */
    public function destroy($entity_id);

    /**
     * Destroy all entities
     *
     * @return void
     */
    public function destroyAll();

    /**
     * Use for quick generate list of items for dropdown elements
     *
     * @param string $value
     * @param string $key
     *
     * @return array
     */
    public function getForSelect($value = 'id', $key = null): array;
}