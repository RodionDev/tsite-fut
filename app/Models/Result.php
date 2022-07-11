<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Result extends Model
{
    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id');
    }
    public function motm()
    {
        return $this->belongsTo('App\Models\Team', 'motm_id');
    }
    public function matches()
    {
        return $this->belongsToMany('App\Models\Match');
    }
}
