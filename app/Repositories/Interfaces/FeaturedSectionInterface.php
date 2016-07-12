<?php namespace Admin\Repositories\Interfaces;

use Admin\FeaturedSection;

interface FeaturedSectionInterface
{
    /**
     * Get all FeaturedSection by attributes
     *
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return FeaturedSection
     */
    public function getAll(array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Get FeaturedSection by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Get count of featured section
     *
     * @return integer
     */
    public function getCount();

    /**
     * Get FeaturedSection by id.
     *
     * @param integer $id
     * @param array $relations
     *
     * @return Admin
     */
    public function getByIdWithRelations($id, array $relations);

    /**
     * Get FeaturedSection by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return FeaturedSection
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Get FeaturedSection by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes);

    /**
     * Get all FeaturedSection by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return FeaturedSection
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC');

    /**
     * Get all FeaturedSection by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return FeaturedSection
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Update an featuredSection by attributes with cnoditions.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributesWithCondition(array $attributes, array $payload);

    /**
     * Create new featuredSection.
     *
     * @param array $payload
     *
     * @return FeaturedSection
     */
    public function create($payload);

    /**
     * Update a featuredSection by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a featuredSection by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Delete an featuredSection.
     *
     * @param integer $id
     * @return FeaturedSection
     */
    public function delete($id);

    /**
     * Delete a featuredSection by attributes.
     *
     * @param array $attributes
     * @return FeaturedSection
     */
    public function deleteByAttributes(array $attributes);
}
