<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class AppUserBlurb extends Model
{
    protected $table = 'app_user_blurb';

    protected $fillable = [
        'app_user_id', 'blurb_id', 'interaction_type',
    ];

    public function blurb()
    {
        return $this->belongsTo('Admin\Blurb', 'blurb_id', 'id');
    }
}
