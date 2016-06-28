<?php namespace Admin\Repositories\Eloquent;

use Admin\Notification;
use Admin\Repositories\Interfaces\NotificationInterface;
use Auth;

class NotificationEloquent implements NotificationInterface
{
    /**
     * @var Notification
     */
    private $notification;

    /**
     * Create a new Notification Eloquent instance.
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Get Notification.
     *
     * @return Admin
     */
    public function get()
    {
        return $this->notification
            ->select('campaign.id as cid', 'campaign.campaign_name', 'campaign.merchant_id as cmid', 'notification.*')
            ->leftJoin('campaign', 'notification.campaign_id', '=', 'campaign.id')
            ->where('notification.merchant_id', Auth::user()->id)
            ->orderBy('notification.updated_at', 'DESC')
            ->limit(10)
            ->get()
            ->toArray();
    }

    /**
     * Get Notification count.
     *
     * @return integer
     */
    public function count()
    {
        return $this->notification
            ->select('campaign.id as cid', 'campaign.campaign_name', 'campaign.merchant_id as cmid', 'notification.*')
            ->leftJoin('campaign', 'notification.campaign_id', '=', 'campaign.id')
            ->where(['campaign.merchant_id' => Auth::user()->id, 'seen' => 0])
            ->count();
    }

    /**
     * Get Notification by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->notification->find($id);
    }

    /**
     * Get Notification by id and attributes.
     *
     * @param integer $id
     * @param array $attributes
     * @return Admin
     */
    public function getByIdAndAttiributes($id, array $attributes)
    {
        return $this->notification->where($attributes)->find($id);
    }

    /**
     * Get Notification by attributes.
     *
     * @param array $attributes
     * @param boolean $toArray
     * @return Notification
     */
    public function getByAttributes(array $attributes, $toArray = true)
    {
        if ($toArray) {
            return $this->notification->where($attributes)->get()->toArray();
        }

        return $this->notification->where($attributes)->first();
    }

    /**
     * Get all Notification by attributes
     *
     * @param array $attributes
     * @param string $orderBy
     * @param string $sort
     * @return Notification
     */
    public function getAllByAttributes(array $attributes, $orderBy = '', $sort = 'ASC')
    {
        return $this->notification->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Get all Notification by attributes with relationships
     *
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sort
     * @return Notification
     */
    public function getAllByAttributesWithRelations(array $attributes, array $relations, $orderBy = '', $sort = 'ASC')
    {
        return $this->notification->with($relations)->where($attributes)->orderBy($orderBy, $sort)->get()->toArray();
    }

    /**
     * Create an new notification.
     *
     * @param array $payload
     *
     * @return Notification
     */
    public function create($payload)
    {
        return $this->notification->create($payload);
    }

    /**
     * Update an notification by id.
     *
     * @param integer $id
     * @param array $payload
     *
     * @return boolean
     */
    public function updateById($id, array $payload)
    {
        return $this->notification->find($id)->update($payload);
    }

    /**
     * Update an notification by attributes.
     *
     * @param array $attributes
     * @param array $payload
     *
     * @return boolean
     */
    public function updateByAttributes(array $attributes, array $payload)
    {
        return $this->notification->where($attributes)->update($payload);
    }

    /**
     * Delete an notification.
     *
     * @param integer $id
     * @return Notification
     */
    public function delete($id)
    {
        return $this->notification->find($id)->delete();
    }

    /**
     * Delete a notification by attributes.
     *
     * @param array $attributes
     * @return Notification
     */
    public function deleteByAttributes(array $attributes)
    {
        return $this->notification->where($attributes)->delete();
    }
}
