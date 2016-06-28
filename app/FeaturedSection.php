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
        'merchant_id', 'position', 'slide_image', 'status'
    ];
}
