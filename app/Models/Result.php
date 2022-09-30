<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Result extends Model
{
    public $table = 'result';
    public $timestamps = false;
    protected $fillable = [
        'score', 'motm_id', 'team_id'
    ];
    public function team()
    {   
        return $this->belongsTo('App\Models\Team', 'team_id');
    }
    public function motm()
    {
        return $this->belongsTo('App\Models\Team', 'motm_id');
    }
    public function result1()
    {
        return $this->belongsTo('App\Models\Match', 'result1_id');
    }
    public function result2()
    {
        return $this->belongsTo('App\Models\Match', 'result2_id');
    }
}
