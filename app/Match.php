<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Match extends Model
{
    public $table = 'match';
    public $timestamps = false;
    protected $fillable = [
        'number', 'finished', 'tournament_id'
    ];
    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament', 'tournament_id');
    }
    public function result1()
    {
        return $this->belongsTo('App\Models\Result', 'result1_id');
    }
    public function result2()
    {
        return $this->belongsTo('App\Models\Result', 'result2_id');
    }
    public function results()
    {
        $results = array();
        $result[] = $this->result1();
        $result[] = $this->result2();
        return $results;
    }
}
