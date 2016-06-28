<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id', 'res_name', 'res_logo', 'res_logo_background', 'res_url',
    ];
}
