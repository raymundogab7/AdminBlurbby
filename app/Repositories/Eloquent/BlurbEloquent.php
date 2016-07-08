<?php namespace Admin\Repositories\Eloquent;

use Admin\Blurb;
use Admin\Repositories\Interfaces\BlurbInterface;

class BlurbEloquent implements BlurbInterface
{
    /**
     * @var Blurb
     */
    private $blurb;

    /**
     * Create a new Blurb Eloquent instance.
     *
     * @return void
     */
    public function __construct(Blurb $blurb)
    {
        $this->blurb = $blurb;
    }

    /**
     * Get Blurb by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->blurb->find($id);
    }

    /**
     * Get Blurb by id.
     *
     * @param integer $id
     * @param array $relations
     *
     * @return Merchant
     */
    public function getByIdWithRelations($id, array $relations)
    {
        return $this->blurb->with($relations)->find($id);
    }


    /**
     * Get Blurb by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes)
    {
        return $this->blurb->where($attributes)->find($id);
    }

    /**
     * Get Blurb by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Blurb
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->blurb->where($attributes)->get()->toArray();
        }

        return $this->blurb->where($attributes)->first();
    }

    /**
     * Get all Blurb by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Blurb
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC')
    {
        return $this->blurb->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Get all Blurb by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Blurb
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC')
    {
        return $this->blurb->with($relations)->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Create an new blurb.
     *
     * @param array $payload
     *
     * @return Blurb
     */
    public function create($payload)
    {
        return $this->blurb->create($payload);
    }

    /**
     * Update an blurb by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->blurb->find($id)->update($payload);
    }

    /**
     * Update an blurb by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->blurb->where($attributes)->update($payload);
    }

    /**
     * Update an blurb by attributes with cnoditions.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributesWithCondition(array $attributes, array $payload)
    {
        return $this->blurb->where($attributes)->where('blurb_end', '>=', date('Y-m-d'))->update($payload);
    }

    /**
     * Delete an blurb.
     *
     * @param integer $id
     * @return Blurb
     */
    public function delete($id)
    {
        return $this->blurb->find($id)->delete();
    }

    /**
     * Delete a blurb by attributes.
     *
     * @param array $attributes
     * @return Blurb
     */
    public function deleteByAttributes(array $attributes)
    {
        return $this->blurb->where($attributes)->delete();
    }
}
