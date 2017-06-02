<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UserTeam extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_team';
    protected $fillable = ['id'];
    public $timestamps = true;
}
 