<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MatchResults extends Model
{
    public $table = 'match_results';
    public $timestamps = false;
    protected $fillable = [
        'result1_id', ' result2_id'
    ];
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
