<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tournament;
use App\Models\Pool;
use App\Models\Team;
use App\Models\Match;
use App\Models\Result;
use Validator;
use DateTime;
class TournamentController extends Controller
{
    public function tournamentsList()
    {
        $user = Auth::User();
        $current_date = date('Y-m-d');  
        if($user->role->permission >= 50)
        {
            $current = Tournament::where('mott_id', null)->whereDate('start_date', '<=', $current_date)->get(); 
            $upcoming = Tournament::whereDate('start_date', '>', $current_date)->get(); 
            $finished = Tournament::whereNotNull('mott_id')->whereDate('start_date', '<', $current_date)->get();    
            $can_edit = true;
        }
        else
        {
            $tournaments = $user->tournaments();
            $current = $tournaments->where('mott_id', null)->whereDate('start_date', '<=', $current_date)->get(); 
            $upcoming = $tournaments->whereDate('start_date', '>', $current_date)->get(); 
            $finished = $tournaments->whereNotNull('mott_id')->whereDate('start_date', '<', $current_date)->get();    
            $can_edit = false;
        }
        return view('pages/tournaments',
        [
            'current_tournaments' => $current,
            'upcoming_tournaments' => $upcoming,
            'finished_tournaments' => $finished,
            'can_edit' => $can_edit
        ]
        );
    }
    protected function generateMatches($pools)
    {
        foreach($pools as $pool)
        {
            $teams = $pool->teams();
            foreach($teams as $team)
            {
                for($i=0; $i<sizeof($teams); $i++ )
                {
                    $result1 = new Result();
                    $result1->team_id = $teams[$i];
                    $result1->save();
                    $result2 = new Result();
                    $result2->team_id = $teams[sizeof($teams) - $i];
                    $result2->save();
                    $match = new Match();
                    $match->round = $i+1;
                    $match->result1_id = $result1->id;
                    $match->result2_id = $result2->id;
                    $match->pool_id = $pool->id;   
                    $match->has_ended = 0;
                    $match->save();
                }
            }
        }
    }
    protected function generatePools($tournament, $teams, $pools=1)
    {
        $teams_iteration = 0;   
        $teams_per_pool = ($teams)/$pools;    
        $teams_too_many = 0;    
        $added_pools = [];  
        $rounded_teams_per_pool = floor($teams_per_pool);
        if(floor($teams_per_pool) !== $teams_per_pool)
            $teams_too_many = ($teams_per_pool - $rounded_teams_per_pool)*pools;  
        for($i=0; $i<$pools; $i++)
        {
            $pool = new Pool();
            $pool->number = $i+1;
            $pool->tournament_id = $tournament->id;
            $pool->finished = 0;
            if($teams_too_many !== 0)
            {
                $extra = 1;
                $teams_too_many -= 1;
            }
            else    $extra = 0;
            $teams_in_pool = [];    
            for($i=0; $i<$teams_per_pool; $i++) 
            {
                $teams_in_pool[] = $teams[$team_iteration]; 
                $teams_iteration++;
            }
            $pool->teams()->attach($teams_in_pool); 
            $pool-save();
            $added_pools[] = $pool; 
        }
        return  $this->generateMatches($added_pools);
    }
    public function create(Request $request, $update=false)
    {
        dd($request->all());
        $this->validator($request->all())->validate();  
        if(Auth::Check()) 
        {
            $user = Auth::user();   
            $role = Role::Find($user->role_id); 
            if($update)
                $tournament = Tournament::find($request->id);
            else
                $tournament = new Tournament();
            if($role->permission >= 50)  
            {                
                $tournament->name = $request->name;
                $tournament->start_date = $request->start_date;
                $tournament->end_date = $request->end_date;
                $tournament->save();
                if($request->teams && $request->pools_amount)
                    return $this->generatePools($tournament, $request->teams, $request->pools_amount);
                return redirect(route('tournaments'));    
            }
            abort(404); 
        }
    }
    public function edit(Request $request)
    {
        return $this->create($request, true);
    }
    public function remove(int $id)
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            $tournament = Tournament::find($id);
            if($user->role->permission >= 50)
            {
                $tournament->delete();
                return redirect(route('tournaments'));
            }
        }
    }
    public function removeByRequest(Request $request)
    {
        return $this->remove($request->id);
    }
    protected function validator(array $data)
    {
        return Validator::make($data,
        [
            'name' => 'required|string|max:199',
            'start_date' => 'date|required',
            'end_date' => 'date|nullable',
            'mott_id' => 'integer|nullable',
        ]);
    }
    public function showNewForm()
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            if($user->role->permission >= 50)
            {
                return view('/pages/cud-tournament')->with('creating', true);
            }
        }
        return redirect(route('home'));
    }
    public function showEditForm(int $id)
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            $tournament = Tournament::find($id);
            if($user->role->permission >= 50)
            {
                return view('/pages/cud-tournament')
                    ->with('creating', false)
                    ->with('tournament', $tournament);
            }
            else    abort(404);     
        }
        return redirect(route('home'));
    }
}
