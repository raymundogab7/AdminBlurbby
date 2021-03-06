<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = "campaign";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'campaign_name', 'cam_start', 'cam_end', 'cam_status', 'cam_timezone', 'cam_read', 'control_no', 'web_live_notif', 'web_expired_notif', 'web_blurb_live_notif', 'web_blurb_expired_notif', 'created_at', 'updated_at', 'restaurant_id',
    ];

    public $timestamps = false;

    public function blurb()
    {
        return $this->hasMany('Admin\Blurb');
    }

    public function snapshot()
    {
        return $this->hasMany('Admin\SnapShot');
    }

    public function restaurant()
    {
        return $this->hasOne('Admin\Restaurant', 'merchant_id', 'merchant_id');
    }

    public function restaurants()
    {
        return $this->hasOne('Admin\Restaurant', 'id', 'restaurant_id');
    }

    public function merchant()
    {
        return $this->belongsTo('Admin\Merchant', 'merchant_id', 'id');
    }
}
