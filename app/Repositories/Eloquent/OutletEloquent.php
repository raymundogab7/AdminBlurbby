<?php namespace Admin\Repositories\Eloquent;

use Admin\Outlet;
use Admin\Repositories\Interfaces\OutletInterface;

class OutletEloquent implements OutletInterface
{
    /**
     * @var Outlet
     */
    private $outlet;

    /**
     * Create a new Outlet Eloquent instance.
     *
     * @return void
     */
    public function __construct(Outlet $outlet)
    {
        $this->outlet = $outlet;
    }

    /**
     * Get Outlet by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->outlet->find($id);
    }

    /**
     * Get Outlet by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Outlet
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->outlet->where($attributes)->get()->toArray();
        }

        return $this->outlet->where($attributes)->first();
    }

    /**
     * Create an new outlet.
     *
     * @param array $payload
     *
     * @return Outlet
     */
    public function create($payload)
    {
        return $this->outlet->create($payload);
    }

    /**
     * Update an outlet by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->outlet->find($id)->update($payload);
    }

    /**
     * Update an outlet by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->outlet->where($attributes)->update($payload);
    }

    /**
     * Delete an outlet.
     *
     * @param integer $id
     * @return Outlet
     */
    public function delete($id)
    {
        return $this->outlet->find($id)->delete();
    }
}
