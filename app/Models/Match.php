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
    public function matchResults()
    {
        return $this->belongsTo('App\Models\MatchResults', 'match_results_id');
    }
    public function results()
    {
        return $this->matchResults()->results();
    }
}
