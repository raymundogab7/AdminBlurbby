<?php namespace Admin\Repositories\Interfaces;

use Admin\AppUser;

interface AppUserInterface
{
    /**
     * Get appUser by id.
     *
     * @param integer $id
     *
     * @return AppUser
     */
    public function getById($id);

    /**
     * Get all AppUser this week.
     *
     * @return AppUser
     */
    public function getAllThisWeek();

    /**
     * Get all AppUser last week.
     *
     * @return AppUser
     */
    public function getAllLastWeek();

    /**
     * Get count of AppUser.
     *
     * @return integer
     */
    public function getCount();

    /**
     * Update a appUser by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a appUser by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Create new appUser.
     *
     * @param array $payload
     *
     * @return AppUser
     */
    public function create(array $payload);
}
