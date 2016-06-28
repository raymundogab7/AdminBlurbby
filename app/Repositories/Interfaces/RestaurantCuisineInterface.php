<?php namespace Admin\Repositories\Interfaces;

use Admin\RestaurantCuisine;

interface RestaurantCuisineInterface
{
    /**
     * Get Restaurant Cuisine by attributes.
     *
     * @param integer $id
     * @param boolean $toArray
     * @return restaurantCuisine
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Create a new Restaurant Cuisine Cuisine.
     *
     * @param array $payload
     *
     * @return Restaurant Cuisine
     */
    public function create($payload);

    /**
     * Update a Restaurant Cuisine by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update an outlet by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Delete Restaurant Cuisine.
     *
     * @param integer $id
     *
     * @return Restaurant Cuisine
     */
    public function delete($id);

    /**
     * Delete Restaurant Cuisine by attributes.
     *
     * @param array $attributes
     * @param array $condition
     *
     * @return restaurantCuisine
     */
    public function deleteByAttributes(array $attributes, array $condition);
}
