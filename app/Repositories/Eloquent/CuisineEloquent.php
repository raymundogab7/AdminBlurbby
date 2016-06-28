<?php namespace Admin\Repositories\Eloquent;

use Admin\Cuisine;
use Admin\Repositories\Interfaces\CuisineInterface;

class CuisineEloquent implements CuisineInterface
{
    /**
     * @var Cuisine
     */
    private $cuisine;

    /**
     * Create a new Cuisine Eloquent instance.
     *
     * @return void
     */
    public function __construct(Cuisine $cuisine)
    {
        $this->cuisine = $cuisine;
    }

    /**
     * Get all cuisine.
     *
     * @return Cuisine
     */
    public function getAll()
    {
        return $this->cuisine->orderBy('cuisine_name')->get()->toArray();
    }

    /**
     * Get all cuisine for list.
     *
     * @return Cuisine
     */
    public function lists()
    {
        return $this->cuisine->lists( 'cuisine_name', 'id');
    }

    /**
     * Create a new cuisine.
     *
     * @param array $payload
     *
     * @return Cuisine
     */
    public function create($payload)
    {
        return $this->cuisine->create($payload);
    }
}
