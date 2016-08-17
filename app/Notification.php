<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';

    protected $fillable = ['merchant_id', 'campaign_id', 'restaurant_id', 'admin_id', 'status', 'seen', 'blurb_notif', 'blurb_report'];

    public function campaign()
    {
        return $this->belongsTo('Admin\Campaign', 'campaign_id', 'id');
    }
}
