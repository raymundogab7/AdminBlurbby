<?php namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = 'merchant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'status', 'last_online', 'coy_name', 'coy_country', 'coy_add', 'coy_zip', 'coy_phone', 'coy_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
