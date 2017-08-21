# Core module #

Module uses for place base abstract and real classes which can be reused in future


## Entityt functionality ##

Extend EntityRepo class and you will have base methods for work with entities


```
#!php
<?php

/**
     * Get all entities
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get entity by ID
     *
     * @param integer $entity_id
     * @return mixed
     */
    public function getByID($entity_id);

    /**
     * Create new entity
     *
     * @param array $entity_data
     * @return mixed
     */
    public function create(array $entity_data);

    /**
     * Update entity by ID
     *
     * @param integer $entity_id
     * @param array $entity_data
     * @return mixed
     */
    public function update($entity_id, array $entity_data);

    /**
     * Destroy entity by ID
     *
     * @param integer $entity_id
     * @return mixed
     */
    public function destroy($entity_id);

    /**
     * Destroy all entities
     *
     * @return mixed
     */
    public function destroyAll();

    /**
     * Use for quick generate list of items for dropdown elements
     *
     * @param string $value
     * @param null $key
     * @return mixed
     */
    public function getForSelect($value = 'id', $key = null);

```