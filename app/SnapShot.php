<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class SnapShot extends Model
{
    protected $table = 'snapshot';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'campaign_id', 'restaurant_id', 'blurb_id', 'snapshot_date', 'snapshot_likes', 'snapshot_views', 'snapshot_uviews', 'snapshot_usage',
    ];

    public function campaign()
    {
    	return $this->belongsTo('Admin\Campaign', 'campaign_id', 'id');
    }
}
