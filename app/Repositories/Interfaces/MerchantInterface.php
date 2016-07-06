<?php namespace Admin\Repositories\Interfaces;

use Admin\Merchant;

interface MerchantInterface
{
    /**
     * Get total status merchants.
     *
     * @return integer
     */
    public function getTotalCount();

    /**
     * Get total merchants in last 30 days.
     *
     * @return integer
     */
    public function getTotalMonth();

    /**
     * Get total status merchants.
     *
     * @param string $status
     * @return merchant
     */
    public function getCount($status = 'Live');

    /**
     * Get All merchant.
     *
     * @return Admin
     */
    public function getAll();

    /**
     * Get all merchant with relationships
     *
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return merchant
     */
    public function getAllWithRelations(array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Get All merchant by attributes.
     *
     * @param array $attributes
     * @param boolean $paginate
     * @return merchant
     */
    public function getAllWithAttributes(array $attributes, $paginate = false);

    /**
     * Search campaings
     *
     * @param array $attributes
     * @param string $search_field
     * @param boolean $paginate
     * @return merchant
     */
    public function search($search_field, $search_type);

    /**
     * Get all SnapShot this week.
     *
     * @param array $attributes
     * @return merchant
     */
    public function getAllThisWeek(array $attributes);

    /**
     * Get all merchant last week.
     *
     * @param array $attributes
     * @return merchant
     */
    public function getAllLastWeek(array $attributes);

    /**
     * Get merchant by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Get merchant by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return merchant
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Get merchant by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes);

    /**
     * Get all merchant by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return merchant
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC');

    /**
     * Get all merchant by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return merchant
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Create new merchant.
     *
     * @param array $payload
     *
     * @return merchant
     */
    public function create($payload);

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
     * Delete an merchant.
     *
     * @param integer $id
     * @return merchant
     */
    public function delete($id);
}
