<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pool extends Model
{
    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament', 'tournament_id');
    }
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }
}
