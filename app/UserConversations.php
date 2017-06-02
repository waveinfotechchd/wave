<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UserConversations extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_conversations';
    protected $fillable = ['id'];
    public $timestamps = true;
}
 