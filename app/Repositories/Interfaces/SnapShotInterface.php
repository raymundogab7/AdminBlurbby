<?php namespace Admin\Repositories\Interfaces;

use Admin\SnapShot;

interface SnapShotInterface
{
	/**
     * Get SnapShot by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return SnapShot
     */
    public function getByAttributes(array $attributes, $toArray = true);

    /**
     * Get SnapShot by attributes with sum.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesWithSum(array $attributes, $field = '');

    /**
     * Get SnapShot by attributes this week.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesThisWeek(array $attributes, $field = '');

    /**
     * Get SnapShot by attributes last week.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesLastWeek(array $attributes, $field = '');

    /**
     * Get SnapShot by attributes last seven days.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesLastSevenDays(array $attributes, $field = '');

    /**
     * Create a new SnapShot Cuisine.
     *
     * @param array $payload
     *
     * @return SnapShot
     */
    public function create($payload);
}
