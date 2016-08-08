<?php namespace Admin\Repositories\Eloquent;

use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\SnapShot;
use Carbon\Carbon;

class SnapShotEloquent implements SnapShotInterface
{
    /**
     * @var SnapShot
     */
    private $snapshot;

    /**
     * Create a new snapshot Eloquent instance.
     *
     * @return void
     */
    public function __construct(SnapShot $snapshot)
    {
        $this->snapshot = $snapshot;
    }

    /**
     * Get SnapShot by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return SnapShot
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->snapshot->where($attributes)->get()->toArray();
        }

        return $this->snapshot->where($attributes)->first();
    }

    /**
     * Get all SnapShot with sum.
     *
     * @param string $field
     * @return SnapShot
     */
    public function getAllWithSum($field = '')
    {
        return $this->snapshot->sum($field);
    }

    /**
     * Get SnapShot by attributes with sum.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesWithSum(array $attributes, $field = '')
    {
        return $this->snapshot->where($attributes)->sum($field);
    }

    /**
     * Get all SnapShot this week.
     *
     * @param string $field
     * @return SnapShot
     */
    public function getAllThisWeek($field = '')
    {
        $now = Carbon::today();
        $today = $now->toDateString();
        $last_sun = new Carbon('last sunday');
        $last_sunday = $last_sun->toDateString();

        return $this->snapshot->whereBetween('snapshot_date', array($last_sunday, $today))->sum($field);
    }

    /**
     * Get all SnapShot last week.
     *
     * @param string $field
     * @return SnapShot
     */
    public function getAllLastWeek($field = '')
    {
        $last_sat = new Carbon('last saturday');
        $last_saturday = $last_sat->toDateString();

        $last_sun = new Carbon('last sunday');
        $last_last_sunday = $last_sun->subWeek()->toDateString();

        return $this->snapshot->whereBetween('snapshot_date', array($last_last_sunday, $last_saturday))->sum($field);
    }

    /**
     * Get SnapShot by attributes this week.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesThisWeek(array $attributes, $field = '')
    {
        $now = Carbon::today();
        $today = $now->toDateString();
        $last_sun = new Carbon('last sunday');
        $last_sunday = $last_sun->toDateString();

        return $this->snapshot->where($attributes)->whereBetween('snapshot_date', array($last_sunday, $today))->sum($field);
    }

    /**
     * Get SnapShot by attributes last week.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesLastWeek(array $attributes, $field = '')
    {
        $last_sat = new Carbon('last saturday');
        $last_saturday = $last_sat->toDateString();

        $last_sun = new Carbon('last sunday');
        $last_last_sunday = $last_sun->subWeek()->toDateString();

        return $this->snapshot->where($attributes)->whereBetween('snapshot_date', array($last_last_sunday, $last_saturday))->sum($field);
    }

    /**
     * Get SnapShot by attributes last seven days.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getByAttributesLastSevenDays(array $attributes, $field = '')
    {
        //$today = Carbon::now('Asia/Singapore')->toDateString();
        //$timezone = new Carbon('Asia/Singapore');

        $today = Carbon::now()->toDateString();
        $timezone = new Carbon();
        $last_seventh = $timezone->subDays(6);

        $record = array();

        $records = $this->snapshot
            ->select('merchant_id', 'snapshot_date', $field)
            ->where($attributes)
            ->whereBetween('snapshot_date', array($last_seventh->toDateString(), $today))
            ->get()
            ->toArray();

        foreach ($records as $key => $value) {
            $record[$value['snapshot_date']] = $value[$field];
        }

        for ($i = 0; $i < 7; $i++) {
            //$timezone = new Carbon('Asia/Singapore');
            $timezone = new Carbon();

            $orig_date_format = $timezone->subDays(6)->addDays($i)->toDateString();

            $ticks[] = [$i, date_format(date_create($orig_date_format), 'd-M-y')];

            $data[] = (!array_key_exists($orig_date_format, $record)) ? [$i, 0] : [$i, $record[$orig_date_format]];
        }

        return ['ticks' => $ticks, 'data' => $data];
    }

    /**
     * Create a new SnapShot Cuisine.
     *
     * @param array $payload
     *
     * @return SnapShot
     */
    public function create($payload)
    {
        return $this->snapshot->create($payload);
    }
}
