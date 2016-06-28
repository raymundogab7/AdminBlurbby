<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class RestaurantCuisine extends Model
{
    protected $table = 'restaurant_cuisine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restaurant_id', 'cuisine_id',
    ];

    public function cuisine()
    {
    	return $this->belongsTo('Admin\Cuisine', 'cuisine_id', 'id');
    }
}
