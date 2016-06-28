<?php

namespace Admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';

    protected $fillable = ['modified_by', 'page_title', 'page_content', 'page_last_updated'];
}
