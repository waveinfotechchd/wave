<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserSearch extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_search';
    protected $fillable = ['user_id'];
    public $timestamps = false;
   
}
