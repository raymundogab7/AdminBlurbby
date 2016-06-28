<?php namespace Admin\Repositories\Interfaces;

use Admin\Campaign;

interface CampaignInterface
{
    /**
     * Get All Campaign.
     *
     * @return Admin
     */
    public function getAll();

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
