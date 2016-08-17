<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class FeaturedSection extends Model
{
    protected $table = 'featured_section';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'position', 'slide_image', 'status',
    ];

    public function merchant()
    {
        return $this->belongsTo('Admin\Merchant', 'merchant_id', 'id');
    }

    public function restaurant()
    {
        return $this->belongsTo('Admin\Restaurant', 'merchant_id', 'merchant_id');
    }
}
