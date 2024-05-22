<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\DateController;
class Match extends Model
{
    public $table = 'match';
    public $timestamps = false;
    protected $fillable = [
        'number', 'finished', 'tournament_id'
    ];
    public function tournament()
    {
        return $this->pool()->tournament();
    }
    public function extraTournament()
    {
        return $this->belongsTo('App\Models\Tournament', 'tournament_id');
    }
    public function pool()
    {
        return $this->hasOne('App\Models\Pool', 'pool_id');
    }
    public function result1()
    {
        return $this->hasOne('App\Models\Result', 'id', 'result1_id');
    }
    public function result2()
    {
        return $this->hasOne('App\Models\Result', 'id', 'result2_id');
    }
    public function results()
    {
        $results = array();
        $result[] = $this->result1();
        $result[] = $this->result2();
        return $results;
    }
    public function getDutchDate($year=true)
    {
        $date_controller = new DateController;
        return $date_controller->dutchDate($this->start, $year);
    }
    public function scopeMyFirstMatch($query, $tournament_id, $user_id)
    {
        $my_match = Match::where('tournament_id', $tournament_id)->get();
        dd($my_match);
    }
}
