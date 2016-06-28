<?php namespace Admin\Repositories\Eloquent;

use Admin\Admin;
use Admin\Repositories\Interfaces\AdminInterface;

class AdminEloquent implements AdminInterface
{
    /**
     * @var Admin
     */
    private $merchant;

    /**
     * Create a new Admin Eloquent instance.
     *
     * @param Admin $merchant
     * @return void
     */
    public function __construct(Admin $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Get merchant by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->merchant->find($id);
    }

    /**
     * Update a merchant by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->merchant->find($id)->update($payload);
    }

    /**
     * Update a merchant by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->merchant->where($attributes)->update($payload);
    }
    /**
     * Create new merchant.
     *
     * @param array $payload
     *
     * @return Admin
     */
    public function create(array $payload)
    {
        return $this->merchant->create($payload);
    }
}
