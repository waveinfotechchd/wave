<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UserInvites extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_invites';
    protected $fillable = ['id'];
    public $timestamps = true;
}
 