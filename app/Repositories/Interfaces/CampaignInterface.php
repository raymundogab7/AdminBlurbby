<?php namespace Admin\Repositories\Interfaces;

use Admin\Campaign;

interface CampaignInterface
{
    /**
     * Get total status campaigns.
     *
     * @return integer
     */
    public function getTotalCount();

    /**
     * Get total campaigns in last 30 days.
     *
     * @return integer
     */
    public function getTotalMonth();

    /**
     * Get total status campaigns.
     *
     * @param string $status
     * @return Campaign
     */
    public function getCount($status = 'Live');

    /**
     * Get All Campaign.
     *
     * @return Admin
     */
    public function getAll();

    /**
     * Get all Campaign with relationships
     *
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Campaign
     */
    public function getAllWithRelations(array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Get All Campaign by attributes.
     *
     * @param array $attributes
     * @param boolean $paginate
     * @return Campaign
     */
    public function getAllWithAttributes(array $attributes, $paginate = false);

    /**
     * Search campaings
     *
     * @param array $attributes
     * @param string $search_field
     * @param boolean $paginate
     * @return Campaign
     */
    public function search($search_field, $search_type);

    /**
     * Get all SnapShot this week.
     *
     * @param array $attributes
     * @return Campaign
     */
    public function getAllThisWeek(array $attributes);

    /**
     * Get all Campaign last week.
     *
     * @param array $attributes
     * @return Campaign
     */
    public function getAllLastWeek(array $attributes);

    /**
     * Get Campaign by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Get Campaign by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Campaign
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Get Campaign by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes);

    /**
     * Get all Campaign by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Campaign
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC');

    /**
     * Get all Campaign by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Campaign
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Create new campaign.
     *
     * @param array $payload
     *
     * @return Campaign
     */
    public function create($payload);

    /**
     * Update a campaign by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a campaign by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Delete an campaign.
     *
     * @param integer $id
     * @return Campaign
     */
    public function delete($id);
}
