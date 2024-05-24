<?php
namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Team extends Model
{
    public $table = 'team';
    public $timestamps = false;
    protected $fillable = [
        'name', 'logo', 'leader_id'
    ];
    public function leader()
    {
        return $this->belongsTo('App\Models\User', 'leader_id');
    }
    public function players()
    {
        return $this->belongsToMany('App\Models\User')->withPivot('squad_number');
    }
    public function pools()
    {
        return $this->belongsToMany('App\Models\Pool');
    }
    public function results()
    {
        return $this->hasMany('App\Models\Result', 'team_id');
    }
    public function matches()
    {
    }
    public function getTeamsByPools($pool_id)
    {
        $raw_teams = DB::table('pool_team')->where('pool_id', $pool_id)->get();
        $teams = [];
        foreach ($raw_teams as $key => $team) 
        {
            $team = Team::find($team->team_id);
            array_push($teams, $team);
        }
        return $teams;
    }
    public function scopeSearchName($query, $name)
    {
        return Team::select('name','logo', 'leader_id', 'id')
            ->where(function($query) use($name)
        {
            $query->where('name', 'like', '%'.$name.'%');
        });
    }
    public function addPlayerToTeam($user_id, $team_id)
    {
        $teams_and_users = DB::table('team_user')->get()->all();
        foreach ($teams_and_users as $key => $team_and_user) 
        {
            if($team_and_user->user_id == $user_id && $team_and_user->team_id == $team_id)
            {
                continue;
            }
            elseif ($team_and_user->user_id != $user_id) 
            {
                continue;
            }
            else
            {
                return DB::table('team_user')->insert(
                    ['team_id' => $team_id, 'user_id' => $user_id]
                );
            }
        }
    }
}
