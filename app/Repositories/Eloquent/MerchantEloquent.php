<?php
namespace Admin\Repositories\Eloquent;

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
     * @return void
     */
    public function __construct(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Get total status merchants.
     *
     * @param string $status
     * @return Merchant
     */
    public function getCount($status = 0)
    {
        return $this->merchant->where('status', $status)->count();
    }

    /**
     * Get total status merchants.
     *
     * @return integer
     */
    public function getTotalCount()
    {
        return $this->merchant->count();
    }

    /**
     * Get total merchants in last 30 days.
     *
     * @return integer
     */
    public function getTotalMonth()
    {
        //$today = Carbon::now('Asia/Singapore')->toDateString();
        //$timezone = new Carbon('Asia/Singapore');

        $today = Carbon::now()->toDateString();
        $timezone = new Carbon();
        $last_thirty_days = $timezone->subDays(30);

        return $this->merchant->whereBetween('date_created', array($last_thirty_days, $today))->count();
    }

    /**
     * Get total merchants in last 30 days.
     *
     * @return integer
     */
    public function getLastThirtyDays()
    {
        $today = Carbon::now()->toDateString();
        $timezone = new Carbon();
        $last_thirty_days = $timezone->subDays(30);

        return $this->merchant->with(['restaurant'])->whereBetween('date_created', array($last_thirty_days, $today))->orderByRaw("FIELD(status , 0, 1, 3, 2) ASC")->paginate(10);
    }

    /**
     * Get All Merchant.
     *
     * @param boolean $paginate
     * @return Merchant
     */
    public function getAll($paginate = false)
    {
        if (!$paginate) {

            return $this->merchant->with('restaurant')->get()->toArray();

        }

        return $this->merchant->with('restaurant')->orderByRaw("FIELD(status , 0, 1, 3, 2) ASC")->paginate(10);
    }

    /**
     * Get All Merchant by attributes.
     *
     * @param array $attributes
     * @param boolean $paginate
     * @return Merchant
     */
    public function getAllWithAttributes(array $attributes, $paginate = false)
    {
        if (!$paginate) {

            return $this->merchant->where($attributes)->with('restaurant')->get()->toArray();

        }

        return $this->merchant->with('restaurant')->where($attributes)->orderBy('coy_name')->paginate(10);
    }

    /**
     * Search campaings
     *
     * @param array $attributes
     * @param string $search_field
     * @param boolean $paginate
     * @return Merchant
     */
    public function search($search_word, $search_type)
    {
        if ($search_type == 'Company') {
            //return $this->merchant->where('coy_name', $search_word)->with('restaurant')->orderBy('coy_name')->paginate(10);
            return \DB::table('merchant')->select('restaurant.id AS res_id', 'restaurant.res_name', 'restaurant.res_logo', 'restaurant.photo_location', 'merchant.id as mer_id', 'merchant.coy_name', 'merchant.email', 'merchant.status', 'merchant.coy_phone', 'merchant.last_online', 'merchant.coy_url')
                ->leftJoin('restaurant', 'merchant.id', '=', 'restaurant.merchant_id')
                ->where('merchant.coy_name', 'LIKE', '%' . $search_word . '%')
                ->orderBy('merchant.coy_name')
                ->paginate(10);
        }

        if ($search_type == 'Restaurant') {
            return \DB::table('merchant')->select('restaurant.id AS res_id', 'restaurant.res_name', 'restaurant.res_logo', 'restaurant.photo_location', 'merchant.id as mer_id', 'merchant.coy_name', 'merchant.email', 'merchant.status', 'merchant.coy_phone', 'merchant.last_online', 'merchant.coy_url')
                ->leftJoin('restaurant', 'merchant.id', '=', 'restaurant.merchant_id')
                ->where('restaurant.res_name', 'LIKE', '%' . $search_word . '%')
                ->orderBy('merchant.coy_name')
                ->paginate(10);
        }

        if ($search_type == 'Email') {
            //return $this->merchant->where('email', $search_word)->with('restaurant')->orderBy('coy_name')->paginate(10);
            return \DB::table('merchant')->select('restaurant.id AS res_id', 'restaurant.res_name', 'restaurant.res_logo', 'restaurant.photo_location', 'merchant.id as mer_id', 'merchant.coy_name', 'merchant.email', 'merchant.status', 'merchant.coy_phone', 'merchant.last_online', 'merchant.coy_url')
                ->leftJoin('restaurant', 'merchant.id', '=', 'restaurant.merchant_id')
                ->where('merchant.email', 'LIKE', '%' . $search_word . '%')
                ->orderBy('merchant.coy_name')
                ->paginate(10);

        }

        return abort(404);
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
     * Get Merchant by id.
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
     * Get Merchant by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Merchant
     */
    public function getByIdAndAttiributes($id, array $attributes)
    {
        return $this->merchant->where($attributes)->find($id);
    }

    /**
     * Get Merchant by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Merchant
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->merchant->where($attributes)->get()->toArray();
        }

        return $this->merchant->where($attributes)->first();
    }

    /**
     * Get all Merchant by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Merchant
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC')
    {
        return $this->merchant->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Get all Merchant with relationships
     *
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Merchant
     */
    public function getAllWithRelations(array $relations, $orderBy = '', $sort = 'ASC')
    {
        return $this->merchant->with($relations)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Get all Merchant by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Merchant
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC')
    {
        return $this->merchant->with($relations)->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Create an new merchant.
     *
     * @param array $payload
     *
     * @return Merchant
     */
    public function create($payload)
    {
        return $this->merchant->create($payload);
    }

    /**
     * Update an merchant by id.
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
     * Update an merchant by attributes.
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
     * Delete an merchant.
     *
     * @param integer $id
     * @return Merchant
     */
    public function delete($id)
    {
        return $this->merchant->find($id)->delete();
    }
}
