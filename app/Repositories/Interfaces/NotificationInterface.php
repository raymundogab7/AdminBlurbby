<?php namespace Admin\Repositories\Interfaces;

use Admin\Notification;

interface NotificationInterface
{
    /**
     * Get Notification.
     *
     * @return Admin
     */
    public function get();

    /**
     * Get Notification count.
     *
     * @return integer
     */
    public function count();

    /**
     * Get Notification by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id);

    /**
     * Get Notification by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Notification
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Get Notification by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes);

    /**
     * Get all Notification by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Notification
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC');

    /**
     * Get all Notification by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Notification
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC');

    /**
     * Create new notification.
     *
     * @param array $payload
     *
     * @return Notification
     */
    public function create($payload);

    /**
     * Update a notification by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload);

    /**
     * Update a notification by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload);

    /**
     * Delete an notification.
     *
     * @param integer $id
     * @return Notification
     */
    public function delete($id);

    /**
     * Delete a notification by attributes.
     *
     * @param array $attributes
     * @return Notification
     */
    public function deleteByAttributes(array $attributes);
}
