<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UserOffers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_offers';
    protected $fillable = ['id'];
    public $timestamps = true;
}
 