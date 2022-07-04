<?php
namespace App;
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
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }
}
