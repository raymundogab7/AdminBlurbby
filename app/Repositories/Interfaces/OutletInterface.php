<?php namespace Admin\Repositories\Interfaces;

use Admin\Outlet;

interface OutletInterface
{
    /**
     * Get Outlet by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Get Outlet by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Outlet
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Create new outlet.
     *
     * @param array $payload
     *
     * @return Outlet
     */
    public function create($payload);

    /**
     * Update a outlet by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a outlet by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Delete an outlet.
     *
     * @param integer $id
     * @return Outlet
     */
    public function delete($id);
}
