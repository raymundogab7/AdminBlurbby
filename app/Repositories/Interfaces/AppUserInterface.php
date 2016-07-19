<?php
namespace Admin\Repositories\Interfaces;

use Admin\AppUser;

interface AppUserInterface
{
    /**
     * Get all app users.
     *
     * @return Admin
     */
    public function getAll();

    /**
     * Get appUser by id.
     *
     * @param integer $id
     *
     * @return AppUser
     */
    public function getById($id);

    /**
     * Get total used blurb in last 30 days.
     *
     * @return integer
     */
    public function getTotalMonth();

    /**
     * Get total online users in last 30 days.
     *
     * @return integer
     */
    public function getLastOnlineTotalMonth();

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
     * Get all AppUser.
     *
     * @return Admin
     */
    public function paginate();

    /**
     * Get count of AppUser.
     *
     * @return integer
     */
    public function getCount();

    /**
     * Get total status of app user.
     *
     * @param string $status
     * @return Campaign
     */
    public function getCountByStatus($status = 'Approved');

    /**
     * Search campaings
     *
     * @param array $attributes
     * @param string $search_field
     * @param boolean $paginate
     * @return Merchant
     */
    public function search($search_word, $search_type);

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
