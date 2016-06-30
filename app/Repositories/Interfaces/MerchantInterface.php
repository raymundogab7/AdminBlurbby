<?php namespace Admin\Repositories\Interfaces;

use Admin\Merchant;

interface MerchantInterface
{
    /**
     * Get merchant by id.
     *
     * @param integer $id
     *
     * @return Merchant
     */
    public function getById($id);

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
     * Create new merchant.
     *
     * @param array $payload
     *
     * @return Merchant
     */
    public function create(array $payload);
}
