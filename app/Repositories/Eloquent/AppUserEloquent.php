<?php namespace Admin\Repositories\Eloquent;

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
     * Get count of AppUser.
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->appUser->count();
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
