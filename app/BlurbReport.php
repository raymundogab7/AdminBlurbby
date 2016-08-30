<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class BlurbReport extends Model
{
    protected $table = 'blurb_report';

    protected $fillable = [
        'merchant_id', 'app_user_id', 'blurb_id', 'restaurant_id', 'campaign_id', 'reason', 'comment', 'notified',
    ];

    public function merchant()
    {
        return $this->belongsTo('Admin\Merchant', 'merchant_id', 'id');
    }

    public function blurb()
    {
        return $this->belongsTo('Admin\Blurb', 'blurb_id', 'id');
    }

    public function appUser()
    {
        return $this->belongsTo('Admin\AppUser', 'app_user_id', 'id');
    }

    public function restaurant()
    {
        return $this->belongsTo('Admin\Restaurant', 'restaurant_id', 'id');
    }

    public function campaign()
    {
        return $this->belongsTo('Admin\Campaign', 'campaign_id', 'id');
    }
}
