<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Blurb extends Model
{
    protected $table = 'blurb';

    protected $fillable = [
        'merchant_id', 'campaign_id', 'blurb_category_id', 'blurb_name', 'blurb_start', 'blurb_end', 'blurb_desc', 'blurb_terms', 'blurb_status', 'blurb_rej_reason', 'blurb_logo', 'control_no', 'photo_location',
    ];

    public function campaign()
    {
        return $this->belongsTo('Admin\Campaign', 'campaign_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('Admin\BlurbCategory', 'blurb_category_id', 'id');
    }

    public function merchant()
    {
        return $this->belongsTo('Admin\Merchant', 'merchant_id', 'id');
    }
}
