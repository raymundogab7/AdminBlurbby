<?php namespace Admin\Repositories\Interfaces;

use Admin\Admin;

interface AdminInterface
{
    /**
     * Get admin by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Get all Admin this week.
     *
     * @return Admin
     */
    public function getAllThisWeek();

    /**
     * Get all Admin last week.
     *
     * @return Admin
     */
    public function getAllLastWeek();

    /**
     * Get count of Admin.
     *
     * @return integer
     */
    public function getCount();

    /**
     * Update a admin by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a admin by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Create new admin.
     *
     * @param array $payload
     *
     * @return Admin
     */
    public function create(array $payload);
}
