<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Team extends Model
{
    public $table = 'team';
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
}
