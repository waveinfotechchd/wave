<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Fieldsets extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'field_sets';
    protected $fillable = ['id'];
    public $timestamps = true;
}
 