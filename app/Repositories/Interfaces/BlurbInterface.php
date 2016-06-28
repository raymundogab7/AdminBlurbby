<?php namespace Admin\Repositories\Interfaces;

use Admin\Blurb;

interface BlurbInterface
{
    /**
     * Get Blurb by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Get Blurb by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Blurb
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Get Blurb by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes);

    /**
     * Get all Blurb by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Blurb
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC');

    /**
     * Get all Blurb by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Blurb
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Update an blurb by attributes with cnoditions.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributesWithCondition(array $attributes, array $payload);

    /**
     * Create new blurb.
     *
     * @param array $payload
     *
     * @return Blurb
     */
    public function create($payload);

    /**
     * Update a blurb by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a blurb by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Delete an blurb.
     *
     * @param integer $id
     * @return Blurb
     */
    public function delete($id);

    /**
     * Delete a blurb by attributes.
     *
     * @param array $attributes
     * @return Blurb
     */
    public function deleteByAttributes(array $attributes);
}
