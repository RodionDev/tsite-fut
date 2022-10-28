<?php
namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Team extends Model
{
    public $table = 'team';
    public $timestamps = false;
    protected $fillable = [
        'name', 'logo', 'leader_id'
    ];
    public function leader()
    {
        return $this->belongsTo('App\Models\User', 'leader_id');
    }
    public function players()
    {
        return $this->belongsToMany('App\Models\User')->withPivot('squad_number');
    }
    public function pools()
    {
        return $this->belongsToMany('App\Models\Pool');
    }
    public function results()
    {
        return $this->hasMany('App\Models\Result', 'team_id');
    }
    public function matches()
    {
    }
    public function scopeSearchName($query, $name)
    {
        return Team::select('name','logo', 'leader_id', 'id')
            ->where(function($query) use($name)
        {
            $query->where('name', 'like', '%'.$name.'%');
        });
    }
}
