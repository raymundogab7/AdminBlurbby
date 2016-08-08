<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id',
        'outlet_no',
        'main',
        'outlet_name',
        'outlet_add',
        'outlet_zip',
        'outlet_country',
        'outlet_phone',
        'outlet_timezone',
        
        'outlet_mon_active',
        'outlet_mon_start',
        'outlet_mon_end',

        'outlet_tue_active',
        'outlet_tue_start',
        'outlet_tue_end',

        'outlet_wed_active',
        'outlet_wed_start',
        'outlet_wed_end',

        'outlet_thu_active',
        'outlet_thu_start',
        'outlet_thu_end',

        'outlet_fri_active',
        'outlet_fri_start',
        'outlet_fri_end',

        'outlet_sat_active',
        'outlet_sat_start',
        'outlet_sat_end',

        'outlet_sun_active',
        'outlet_sun_start',
        'outlet_sun_end',

        'outlet_ph_active',
        'outlet_ph_start',
        'outlet_ph_end',
        'latitude',
        'longitude'
    ];
}
