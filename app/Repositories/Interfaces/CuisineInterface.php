<?php namespace Admin\Repositories\Interfaces;

use Admin\Cuisine;

interface CuisineInterface
{
    /**
     * Get all cuisine.
     *
     * @return Cuisine
     */
    public function getAll();

    /**
     * Get all cuisine for list.
     *
     * @return Cuisine
     */
    public function lists();

    /**
     * Create new cuisine.
     *
     * @param array $payload
     *
     * @return Cuisine
     */
    public function create($payload);
}
