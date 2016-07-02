<?php namespace Admin\Repositories\Eloquent;

use Admin\Merchant;
use Admin\Repositories\Interfaces\MerchantInterface;
use Carbon\Carbon;

class MerchantEloquent implements MerchantInterface
{
    /**
     * @var Merchant
     */
    private $merchant;

    /**
     * Create a new Merchant Eloquent instance.
     *
     * @param Merchant $merchant
     * @return void
     */
    public function __construct(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Get all merchant.
     *
     * @return Merchant
     */
    public function getAll()
    {
        return $this->merchant->select('id', 'first_name','last_name','coy_name')->get()->toArray();
    }

    /**
     * Get merchant by id.
     *
     * @param integer $id
     *
     * @return Merchant
     */
    public function getById($id)
    {
        return $this->merchant->find($id);
    }

    /**
     * Get all Merchant this week.
     *
     * @return Merchant
     */
    public function getAllThisWeek()
    {
        $now = Carbon::today();
        $today = $now->toDateString();
        $last_sun = new Carbon('last sunday');
        $last_sunday = $last_sun->toDateString();

        return $this->merchant->whereBetween('date_created', array($last_sunday, $today))->count();
    }

    /**
     * Get all Merchant last week.
     *
     * @return Merchant
     */
    public function getAllLastWeek()
    {
        $last_sat = new Carbon('last saturday');
        $last_saturday = $last_sat->toDateString();
        
        $last_sun = new Carbon('last sunday');
        $last_last_sunday = $last_sun->subWeek()->toDateString();

        return $this->merchant->whereBetween('date_created', array($last_last_sunday, $last_saturday))->count();
    }

    /**
     * Get count of Merchant.
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->merchant->count();
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
     * @return Merchant
     */
    public function create(array $payload)
    {
        return $this->merchant->create($payload);
    }
}
