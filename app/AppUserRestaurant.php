<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class AppUserRestaurant extends Model
{
    protected $table = 'app_user_restaurant';

    protected $fillable = [
        'app_user_id', 'restaurant_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo('Admin\Restaurant', 'restaurant_id', 'id');
    }
}
