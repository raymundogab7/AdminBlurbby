<?php namespace Admin\Repositories\Interfaces;

use Admin\Admin;

interface AdminInterface
{
    /**
     * Get merchant by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Update a merchant by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a merchant by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Create new merchant.
     *
     * @param array $payload
     *
     * @return Admin
     */
    public function create(array $payload);
}
