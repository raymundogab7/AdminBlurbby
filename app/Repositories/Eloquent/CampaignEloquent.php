<?php namespace Admin\Repositories\Eloquent;

use Admin\Campaign;
use Admin\Repositories\Interfaces\CampaignInterface;

class CampaignEloquent implements CampaignInterface
{
    /**
     * @var Campaign
     */
    private $campaign;

    /**
     * Create a new Campaign Eloquent instance.
     *
     * @return void
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Get All Campaign.
     *
     * @return Admin
     */
    public function getAll()
    {
        return $this->campaign->with('restaurant')->orderBy('campaign_name')->get()->toArray();
    }

    /**
     * Get Campaign by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->campaign->find($id);
    }

    /**
     * Get Campaign by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes)
    {
        return $this->campaign->where($attributes)->find($id);
    }

    /**
     * Get Campaign by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Campaign
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->campaign->where($attributes)->get()->toArray();
        }

        return $this->campaign->where($attributes)->first();
    }

    /**
     * Get all Campaign by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Campaign
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC')
    {
        return $this->campaign->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Get all Campaign by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Campaign
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC')
    {
        return $this->campaign->with($relations)->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Create an new campaign.
     *
     * @param array $payload
     *
     * @return Campaign
     */
    public function create($payload)
    {
        return $this->campaign->create($payload);
    }

    /**
     * Update an campaign by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->campaign->find($id)->update($payload);
    }

    /**
     * Update an campaign by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->campaign->where($attributes)->update($payload);
    }

    /**
     * Delete an campaign.
     *
     * @param integer $id
     * @return Campaign
     */
    public function delete($id)
    {
        return $this->campaign->find($id)->delete();
    }
}
