<?php
namespace Admin\Repositories\Eloquent;

use Admin\AppUser;
use Admin\Repositories\Interfaces\AppUserInterface;
use Carbon\Carbon;

class AppUserEloquent implements AppUserInterface
{
    /**
     * @var AppUser
     */
    private $appUser;

    /**
     * Create a new AppUser Eloquent instance.
     *
     * @param AppUser $appUser
     * @return void
     */
    public function __construct(AppUser $appUser)
    {
        $this->appUser = $appUser;
    }

    /**
     * Get all app users.
     *
     * @return Admin
     */
    public function getAll()
    {
        return $this->appUser->orderBy('first_name')->get()->toArray();
    }

    /**
     * Get appUser by id.
     *
     * @param integer $id
     *
     * @return AppUser
     */
    public function getById($id)
    {
        return $this->appUser->find($id);
    }

    /**
     * Get total used blurb in last 30 days.
     *
     * @return integer
     */
    public function getTotalMonth()
    {
        $today = Carbon::now('Asia/Singapore')->toDateString();
        $timezone = new Carbon('Asia/Singapore');
        $last_thirty_days = $timezone->subDays(30);

        return $this->appUser->whereBetween('date_created', array($last_thirty_days, $today))->count();
    }

    /**
     * Get total online users in last 30 days.
     *
     * @return integer
     */
    public function getLastOnlineTotalMonth()
    {
        $today = Carbon::now('Asia/Singapore')->toDateString();
        $timezone = new Carbon('Asia/Singapore');
        $last_thirty_days = $timezone->subDays(30);

        return $this->appUser->whereBetween('last_online_date', array($last_thirty_days, $today))->count();
    }

    /**
     * Get all AppUser this week.
     *
     * @return AppUser
     */
    public function getAllThisWeek()
    {
        $now = Carbon::today();
        $today = $now->toDateString();
        $last_sun = new Carbon('last sunday');
        $last_sunday = $last_sun->toDateString();

        return $this->appUser->whereBetween('date_created', array($last_sunday, $today))->count();
    }

    /**
     * Get all AppUser last week.
     *
     * @return AppUser
     */
    public function getAllLastWeek()
    {
        $last_sat = new Carbon('last saturday');
        $last_saturday = $last_sat->toDateString();

        $last_sun = new Carbon('last sunday');
        $last_last_sunday = $last_sun->subWeek()->toDateString();

        return $this->appUser->whereBetween('date_created', array($last_last_sunday, $last_saturday))->count();
    }

    /**
     * Get all AppUser.
     *
     * @return Admin
     */
    public function paginate()
    {
        return $this->appUser->orderBy('first_name')->paginate(10);
    }

    /**
     * Get count of AppUser.
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->appUser->count();
    }

    /**
     * Get total status of app user.
     *
     * @param string $status
     * @return Campaign
     */
    public function getCountByStatus($status = 'Approved')
    {
        return $this->appUser->where('status', $status)->count();
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
            return $this->appUser->where('first_name', 'LIKE', '%' . $search_word . '%')->orderBy('first_name')->paginate(10);
        }

        if ($search_type == 'Last Name') {
            return $this->appUser->where('last_name', 'LIKE', '%' . $search_word . '%')->orderBy('first_name')->paginate(10);
        }

        if ($search_type == 'Email') {
            return $this->appUser->where('email', 'LIKE', '%' . $search_word . '%')->orderBy('first_name')->paginate(10);
        }

        return [];
    }

    /**
     * Update a appUser by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->appUser->find($id)->update($payload);
    }

    /**
     * Update a appUser by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->appUser->where($attributes)->update($payload);
    }
    /**
     * Create new appUser.
     *
     * @param array $payload
     *
     * @return AppUser
     */
    public function create(array $payload)
    {
        return $this->appUser->create($payload);
    }
}
