<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tournament extends Model
{
    public $table = 'tournament';
    public $timestamps = false;
    protected $fillable = [
        'name', 'start_date', 'end_date', 'mott_id'
    ];
    public function pools()
    {
        return $this->hasMany('App\Models\Pool');
    }
    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }
    public function mott()
    {
        return $this->belongsTo('App\Models\User', 'mott_id');
    }
}
