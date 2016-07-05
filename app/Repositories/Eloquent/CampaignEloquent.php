<?php namespace Admin\Repositories\Eloquent;

use Admin\Campaign;
use Admin\Repositories\Interfaces\CampaignInterface;
use Carbon\Carbon;

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
     * Get total status campaigns.
     *
     * @param string $status
     * @return Campaign
     */
    public function getCount($status = 'Live')
    {
        return $this->campaign->where('cam_status', $status)->count();
    }

    /**
     * Get total status campaigns.
     *
     * @return integer
     */
    public function getTotalCount()
    {
        return $this->campaign->count();
    }

    /**
     * Get total campaigns in last 30 days.
     *
     * @return integer
     */
    public function getTotalMonth()
    {
        $today = Carbon::now('Asia/Singapore')->toDateString();
        $timezone = new Carbon('Asia/Singapore');
        $last_thirty_days = $timezone->subDays(30);

        return $this->campaign->whereBetween('date_created', array($last_thirty_days, $today))->count();
    }

    /**
     * Get All Campaign.
     *
     * @param boolean $paginate 
     * @return Campaign
     */
    public function getAll($paginate = false)
    {
        if(!$paginate) {

            return $this->campaign->with('restaurant')->get()->toArray();

        }

        return $this->campaign->with('restaurant')->orderBy('campaign_name')->paginate(10);
    }

    /**
     * Get All Campaign by attributes.
     *
     * @param array $attributes
     * @param boolean $paginate
     * @return Campaign
     */
    public function getAllWithAttributes(array $attributes, $paginate = false)
    {
        if(!$paginate) {

            return $this->campaign->where($attributes)->with('restaurant')->get()->toArray();

        }

        return $this->campaign->with('restaurant')->where($attributes)->orderBy('campaign_name')->paginate(10);
    }

    /**
     * Get all Campaign this week.
     *
     * @param array $attributes
     * @return Campaign
     */
    public function getAllThisWeek(array $attributes)
    {
        $now = Carbon::today();
        $today = $now->toDateString();
        $last_sun = new Carbon('last sunday');
        $last_sunday = $last_sun->toDateString();

        return $this->campaign->where($attributes)->whereBetween('date_created', array($last_sunday, $today))->count();
    }

    /**
     * Get all Campaign last week.
     *
     * @param array $attributes
     * @return Campaign
     */
    public function getAllLastWeek(array $attributes)
    {
        $last_sat = new Carbon('last saturday');
        $last_saturday = $last_sat->toDateString();
        
        $last_sun = new Carbon('last sunday');
        $last_last_sunday = $last_sun->subWeek()->toDateString();

        return $this->campaign->where($attributes)->whereBetween('date_created', array($last_last_sunday, $last_saturday))->count();
    }

    /**
     * Get Campaign by id.
     *
     * @param integer $id
     *
     * @return Campaign
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
     * @return Campaign
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
