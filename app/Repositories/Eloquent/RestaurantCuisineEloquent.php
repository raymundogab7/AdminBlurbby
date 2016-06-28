<?php namespace Admin\Repositories\Eloquent;

use Admin\Repositories\Interfaces\RestaurantCuisineInterface;
use Admin\RestaurantCuisine;

class RestaurantCuisineEloquent implements RestaurantCuisineInterface
{
    /**
     * @var RestaurantCuisine
     */
    private $restaurantCuisine;

    /**
     * Create a new restaurantCuisine Eloquent instance.
     *
     * @return void
     */
    public function __construct(RestaurantCuisine $restaurantCuisine)
    {
        $this->restaurantCuisine = $restaurantCuisine;
    }

    /**
     * Get Restaurant Cuisine by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return restaurantCuisine
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->restaurantCuisine->where($attributes)->get()->toArray();
        }

        return $this->restaurantCuisine->where($attributes)->first();
    }

    /**
     * Get Restaurant Cuisine by attributes with relations.
     *
     * @param array $attributes
     * @param array $relations
     * @return restaurantCuisine
     */
    public function getByAttributesWithRelations(array $attributes, array $relations = [])
    {
        return $this->restaurantCuisine->with($relations)->where($attributes)->get();
    }

    /**
     * Create a new Restaurant Cuisine.
     *
     * @param array $payload
     *
     * @return restaurantCuisine
     */
    public function create($payload)
    {
        return $this->restaurantCuisine->create($payload);
    }

    /**
     * Update a Restaurant Cuisine by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->restaurantCuisine->find($id)->update($payload);
    }

    /**
     * Update an Restaurant by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->outlet->where($attributes)->update($payload);
    }

    /**
     * Delete Restaurant Cuisine.
     *
     * @param integer $id
     *
     * @return restaurantCuisine
     */
    public function delete($id)
    {
        return $this->restaurantCuisine->find($id)->delete();
    }

    /**
     * Delete Restaurant Cuisine by attributes.
     *
     * @param array $attributes
     * @param array $condition
     *
     * @return restaurantCuisine
     */
    public function deleteByAttributes(array $attributes, array $condition)
    {
        return $this->restaurantCuisine
        ->where($attributes)
        ->whereNotIn('cuisine_id', $condition)
        ->delete();
    }
}
