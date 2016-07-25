<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class BlurbCategory extends Model
{
    protected $table = 'blurb_category';

    protected $fillable = [
        'blurb_cat_name',
    ];
}
