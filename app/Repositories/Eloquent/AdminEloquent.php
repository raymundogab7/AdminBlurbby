<?php
namespace Admin\Repositories\Eloquent;

use Admin\Admin;
use Admin\Repositories\Interfaces\AdminInterface;
use Carbon\Carbon;

class AdminEloquent implements AdminInterface
{
    /**
     * @var Admin
     */
    private $admin;

    /**
     * Create a new Admin Eloquent instance.
     *
     * @param Admin $admin
     * @return void
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get admin by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->admin->find($id);
    }

    /**
     * Get all administrators.
     *
     * @return Admin
     */
    public function getAll()
    {
        return $this->admin->orderBy('first_name')->get()->toArray();
    }

    /**
     * Get all administrators.
     *
     * @return Admin
     */
    public function paginate($attributes = null)
    {
        if (is_null($attributes)) {
            return $this->admin->orderBy('first_name')->paginate(10);
        }

        return $this->admin->where($attributes)->orderBy('first_name')->paginate(10);

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
        if ($search_type == 'First Name') {
            return $this->admin->where('first_name', 'LIKE', '%' . $search_word . '%')->orderBy('first_name')->paginate(10);
        }

        if ($search_type == 'Last Name') {
            return $this->admin->where('last_name', 'LIKE', '%' . $search_word . '%')->orderBy('first_name')->paginate(10);
        }

        if ($search_type == 'Position') {
            return $this->admin->where('title', 'LIKE', '%' . $search_word . '%')->orderBy('first_name')->paginate(10);
        }

        if ($search_type == 'Email') {
            return $this->admin->where('email', 'LIKE', '%' . $search_word . '%')->orderBy('first_name')->paginate(10);
        }

        return [];
    }

    /**
     * Get all administrators by attributes.
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Admin
     */
    public function getAllByAttributes(array $attributes, $orderBy, $sort = 'ASC')
    {
        return $this->admin->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Get all Admin this week.
     *
     * @return Admin
     */
    public function getAllThisWeek()
    {
        $now = Carbon::today();
        $today = $now->toDateString();
        $last_sun = new Carbon('last sunday');
        $last_sunday = $last_sun->toDateString();

        return $this->admin->whereBetween('date_created', array($last_sunday, $today))->count();
    }

    /**
     * Get all Admin last week.
     *
     * @return Admin
     */
    public function getAllLastWeek()
    {
        $last_sat = new Carbon('last saturday');
        $last_saturday = $last_sat->toDateString();

        $last_sun = new Carbon('last sunday');
        $last_last_sunday = $last_sun->subWeek()->toDateString();

        return $this->admin->whereBetween('date_created', array($last_last_sunday, $last_saturday))->count();
    }

    /**
     * Get count of Admin.
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->admin->count();
    }

    /**
     * Get Admin by attributes.
     *
     * @param array $attributes
     * @return Admin
     */
    public function getByAttributes(array $attributes)
    {

        return $this->admin->where($attributes)->get()->toArray();

    }

    /**
     * Update a admin by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->admin->find($id)->update($payload);
    }

    /**
     * Update a admin by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->admin->where($attributes)->update($payload);
    }
    /**
     * Create new admin.
     *
     * @param array $payload
     *
     * @return Admin
     */
    public function create(array $payload)
    {
        return $this->admin->create($payload);
    }
}
