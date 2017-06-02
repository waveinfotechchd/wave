<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UserShortlists extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_shortlists';
    protected $fillable = ['id'];
    public $timestamps = true;
}
 