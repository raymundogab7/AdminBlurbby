<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $table = 'app_user';

    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'status', 'last_online', 'gender', 'date_of_birth', 'date_created', 'photo', 'facebook',
    ];
}
