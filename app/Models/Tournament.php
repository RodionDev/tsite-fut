<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\DateController;
class Tournament extends Model
{
    public $table = 'tournament';
    public $timestamps = false;
    protected $fillable = [
        'name', 'start_date', 'end_date', 'mott_id'
    ];
    public function getDutchDate($year=true)
    {
        $date_controller = new DateController;
        $dates = array(
            'start' =>  $date_controller->dutchDate($this->start_date, $year),
            'end'   =>  $date_controller->dutchDate($this->end_date, $year)
        );
        return $dates;
    }
    public function pools()
    {
        return $this->hasMany('App\Models\Pool');
    }
    public function mott()
    {
        return $this->belongsTo('App\Models\User', 'mott_id');
    }
    public function matches($get = false)
    {
        $id = $this->id;
        $matches = Match::whereHas('pool', function($query) use($id)
        {
           $query->where('tournament_id', '=', $id);
        });
        return ($get) ? $matches->get() : $matches;
    }
    public function myFirstMatch($user_id, $get=null)
    {
        $matches = Match::whereHas('result1.team.players', function($query) use($user_id)
        {
           $query->where('user_id', '=', $user_id);
        })
        ->orWhereHas('result2.team.players', function($query) use($user_id)
        {
            $query->where('user_id', '=', $user_id);
        });
        return ($get) ? $matches->get() : $matches;
    }
}
