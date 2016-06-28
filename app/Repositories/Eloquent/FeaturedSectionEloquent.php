<?php namespace Admin\Repositories\Eloquent;

use Admin\FeaturedSection;
use Admin\Repositories\Interfaces\FeaturedSectionInterface;

class FeaturedSectionEloquent implements FeaturedSectionInterface
{
    /**
     * @var FeaturedSection
     */
    private $featuredSection;

    /**
     * Create a new FeaturedSection Eloquent instance.
     *
     * @return void
     */
    public function __construct(FeaturedSection $featuredSection)
    {
        $this->featuredSection = $featuredSection;
    }

    /**
     * Get FeaturedSection by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->featuredSection->find($id);
    }

    /**
     * Get FeaturedSection by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes)
    {
        return $this->featuredSection->where($attributes)->find($id);
    }

    /**
     * Get FeaturedSection by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return FeaturedSection
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->featuredSection->where($attributes)->get()->toArray();
        }

        return $this->featuredSection->where($attributes)->first();
    }

    /**
     * Get all FeaturedSection by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return FeaturedSection
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC')
    {
        return $this->featuredSection->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Get all FeaturedSection by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return FeaturedSection
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC')
    {
        return $this->featuredSection->with($relations)->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Create an new featuredSection.
     *
     * @param array $payload
     *
     * @return FeaturedSection
     */
    public function create($payload)
    {
        return $this->featuredSection->create($payload);
    }

    /**
     * Update an featuredSection by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->featuredSection->find($id)->update($payload);
    }

    /**
     * Update an featuredSection by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->featuredSection->where($attributes)->update($payload);
    }

    /**
     * Update an featuredSection by attributes with cnoditions.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributesWithCondition(array $attributes, array $payload)
    {
        return $this->featuredSection->where($attributes)->where('featuredSection_end', '>=', date('Y-m-d'))->update($payload);
    }

    /**
     * Delete an featuredSection.
     *
     * @param integer $id
     * @return FeaturedSection
     */
    public function delete($id)
    {
        return $this->featuredSection->find($id)->delete();
    }

    /**
     * Delete a featuredSection by attributes.
     *
     * @param array $attributes
     * @return FeaturedSection
     */
    public function deleteByAttributes(array $attributes)
    {
        return $this->featuredSection->where($attributes)->delete();
    }
}
