<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Blurb extends Model
{
    protected $table = 'blurb';

    protected $fillable = [
        'merchant_id', 'campaign_id', 'blurb_category', 'blurb_name', 'blurb_start', 'blurb_end', 'blurb_desc', 'blurb_terms', 'blurb_status', 'blurb_rej_reason', 'blurb_logo', 'control_no'
    ];

    public function campaign()
    {
    	return $this->belongsTo('Admin\Campaign', 'campaign_id', 'id');
    }
}
