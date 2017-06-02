<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Coupons extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'coupons';
    protected $fillable = ['id'];
    public $timestamps = true;
}
 