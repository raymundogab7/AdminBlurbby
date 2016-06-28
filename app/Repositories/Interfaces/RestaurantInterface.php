<?php namespace Admin\Repositories\Interfaces;

use Admin\Restaurant;

interface RestaurantInterface
{
    /**
     * Get restaurant by id.
     *
     * @param integer $id
     *
     * @return Restaurant
     */
    public function getById($id);

    /**
     * Get restaurant by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Restaurant
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Create new restaurant.
     *
     * @param array $payload
     *
     * @return Restaurant
     */
    public function create($payload);

    /**
     * Update a restaurant by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update an restaurant by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);
}
