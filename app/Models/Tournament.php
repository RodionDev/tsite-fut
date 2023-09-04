<?php
namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
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
    public function matches()
    {
        return $this->hasManyThrough('App\Models\Match', 'App\Models\Pool');
    }
    public function extraMatches()
    {
        return $this->hasMany('App\Models\Match');
    }
    public function myPools($get=null)
    {
        $user = Auth::user();
        $id = $user->id;
        $pools = $this->pools()->whereHas('teams.players', function($query) use($id)
        {
           $query->where('id', '=', $id);
        });
        return ($get) ? $pools->get() : $pools;
    }
    public function poolNumber()
    {
        $pools = $this->pools();
        $pool = ($pools) ? $pools->orderBy('number', 'desc')->first() : null;
        return ($pool) ? $pool->number : 0;
    }
    public function myMatches($user_id)
    {
        $matches = $this->matches();
        $my_match = $matches->whereNotNull('start')->whereHas('result1.team.players', function($query) use($user_id)
        {
           $query->where('id', '=', $user_id);
        })
        ->orWhereHas('result2.team.players', function($query) use($user_id)
        {
            $query->where('id', '=', $user_id);
        });
        return $my_match->orderBy('start');
    }
    public function myExtraMatches($user_id)
    {
        $matches = $this->extraMatches();
        $my_match = $matches->whereNotNull('start')->whereHas('result1.team.players', function($query) use($user_id)
        {
           $query->where('id', '=', $user_id);
        })
        ->orWhereHas('result2.team.players', function($query) use($user_id)
        {
            $query->where('id', '=', $user_id);
        });
        return $my_match->orderBy('start');
    }
    public function myFirstMatch($user_id)
    {
        $match1 = $this->myMatches($user_id)->first();
        $match2 = $this->myExtraMatches($user_id)->first();
        if($match1 && $match2)
        {
            if( new DateTime($match1->start) < new DateTime($match2->start) )
                return $match1;
            else    return $match2;
        }
        elseif($match1) return $match1;
        elseif($match2) return $match2;
        else return false;
    }
}
