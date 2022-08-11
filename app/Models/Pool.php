<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pool extends Model
{
    public $table = 'pool';
    public $timestamps = false;
    protected $fillable = [
        'number', 'finished', 'tournament_id'
    ];
    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament', 'tournament_id');
    }
    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }
}
