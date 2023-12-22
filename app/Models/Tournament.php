<?php
namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\DateController;
use App\Models\Pool;
use Illuminate\Support\Facades\Auth;
use DateTime;
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
    public function myMatches($user_id, $has_ended=null)
    {
        if($has_ended !== null)
            $matches = $this->matches()->where('has_ended', $has_ended);
        else
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
    public function myExtraMatches($user_id, $has_ended=null)
    {
        if($has_ended !== null)
            $matches = $this->extraMatches()->where('has_ended', $has_ended);
        else
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
        $matches1 = $this->myMatches($user_id, 0)->get();
        $matches2 = $this->myExtraMatches($user_id, 0)->get();
        $matches = $matches1->merge($matches2);
        if($matches)    
        {
            if(sizeof($matches) > 1)
            {
                foreach ($matches as $key => $match)    
                    $sort[$key] = strtotime($match->start);   
                $matches = $matches->all();
                array_multisort($sort, SORT_DESC, $matches); 
                $matches = array_reverse($matches);  
                return $matches[0];
            }
            else    return $matches->first();   
        }
        return false;
    }
}
