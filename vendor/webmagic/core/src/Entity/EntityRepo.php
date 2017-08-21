<?php

namespace Webmagic\Core\Entity;


use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Webmagic\Core\Entity\Exceptions\EntityNotExtendsModelException;
use Webmagic\Core\Entity\Exceptions\ModelNotDefinedException;

abstract class EntityRepo implements EntityRepoInterface
{
    /** @var  Model */
    protected $entity;

    /**
     * Get all entities
     *
     * @return Collection
     */
    public function getAll()
    {
        $query = $this->query();

        return $this->realGetMany($query);
    }

    /**
     * Get all active entities
     *
     * @return Collection
     */
    public function getAllActive()
    {
        $query = $this->query();
        $query = $this->addActiveFilter($query);

        return $this->realGetMany($query);
    }

    /**
     * Add filtering for active entities
     * Condition can be added if you need
     *
     * @param Builder $query
     *
     * @return Builder
     */
    protected function addActiveFilter(Builder $query)
    {
        return $query;
    }

    /**
     * Get entity by ID
     *
     * @param int|string $entity_id
     *
     * @return Model|null
     */
    public function getByID($entity_id)
    {
        $query = $this->query();
        $query->where('id', $entity_id);

        return $this->realGetOne($query);
    }

    /**
     * Get from DB and prepare array with ID as key and name as value
     *
     * @param string $value
     * @param string $key
     * @return array
     */
    public function getForSelect($value = 'id', $key = null): array
    {
        $query = $this->query();

        if (!$entities = $query->pluck($value, $key)) {
            return $entities;
        }

        return $entities->toArray();
    }

    /**
     * Create new entity
     *
     * @param array $entity_data
     * @return Model
     */
    public function create(array $entity_data)
    {
        $query = $this->query();

        return $query->create($entity_data);

    }

    /**
     * Update entity by ID
     *
     * @param int|string $entity_id
     * @param array $entity_data
     *
     * @return int
     */
    public function update($entity_id, array $entity_data)
    {
        $query = $this->query();
        return $query->find($entity_id)->update($entity_data);
    }

    /**
     * Destroy entity by ID
     *
     * @param int|array $entity_id
     * @return int
     */
    public function destroy($entity_id)
    {
        $entity = $this->entity();
        return $entity::destroy($entity_id);
    }

    /**
     * Destroy all entities
     *
     * @return void
     */
    public function destroyAll()
    {
        $query = $this->query();
        return $query->truncate();
    }

    /**
     * Get one entity based on query
     *
     * @param Builder $query
     *
     * @return Model|null
     */
    protected function realGetOne(Builder $query)
    {
        return $query->first();
    }

    /**
     *  Get all entities based on query
     *
     * @param Builder $query
     *
     * @return Collection|Paginator
     */
    protected function realGetMany(Builder $query)
    {
        return $query->get();
    }

    /**
     * Use for prepare query base on defined entity
     *
     * @return Builder
     * @throws Exception
     */
    protected function query(): Builder
    {
        $entity = $this->entity();

        return ($entity)::query();
    }

    /**
     * Check if entity set and return it
     *
     * @return Model
     * @throws EntityNotExtendsModelException
     * @throws ModelNotDefinedException
     */
    protected function entity()
    {
        if(!isset($this->entity)){
            throw new ModelNotDefinedException();
        }

        if(!is_subclass_of($this->entity, Model::class)){
            throw new EntityNotExtendsModelException();
        }

        return $this->entity;
    }
}