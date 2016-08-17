<?php
namespace Admin\Repositories\Eloquent;

use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Restaurant;

class RestaurantEloquent implements RestaurantInterface
{
    /**
     * @var Restaurant
     */
    private $restaurant;

    /**
     * Create a new Restaurant Eloquent instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Get All Restaurant.
     *
     * @return Restaurant
     */
    public function getAll()
    {
        return $this->restaurant->orderBy('res_name')->get()->toArray();
    }

    /**
     * Get Restaurant by id.
     *
     * @param integer $id
     *
     * @return Restaurant
     */
    public function getById($id)
    {
        return $this->restaurant->find($id);
    }

    /**
     * Get Restaurant by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Restaurant
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->restaurant->where($attributes)->get()->toArray();
        }

        return $this->restaurant->where($attributes)->first();
    }

    /**
     * Create a new restaurant.
     *
     * @param array $payload
     *
     * @return Restaurant
     */
    public function create($payload)
    {
        return $this->restaurant->create($payload);
    }

    /**
     * Update a restaurant by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->restaurant->find($id)->update($payload);
    }

    /**
     * Update an restaurant by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->restaurant->where($attributes)->update($payload);
    }
}
