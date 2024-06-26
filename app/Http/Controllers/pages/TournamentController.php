<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Tournament;
use App\Models\Pool;
use App\Models\Team;
use App\Models\Match;
use App\Models\Result;
use App\Models\Role;
use App\Models\User;
use Validator;
use DateTime;
class TournamentController extends Controller
{
    protected function generateMatches($pools)
    {
        foreach($pools as $pool)
        {
            $teams = $pool->teams;
            $teams_size = sizeof($teams);
            foreach($teams as $team)
            {
                for($i=0; $i<$teams_size-1; $i++ )
                {
                    $team_1 = $teams[$i]->id;
                    $team_2_index = $teams_size-1-$i;
                    $team_2 = $teams[$team_2_index]->id;
                    if($team_1 == $team_2)  $team_2 == 1;    
                    $result1 = new Result();
                    $result1->team_id = $team_1;
                    $result1->save();
                    $result2 = new Result();
                    $result2->team_id = $team_2;
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
        return redirect(route('home'));
    }
    protected function generatePools($tournament, $teams, $pools)
    {
        $teams_iteration = 0;   
        $teams_per_pool = sizeof($teams)/$pools;    
        $teams_too_many = 0;    
        $added_pools = [];  
        $pool_count = Tournament::find($tournament->id)->poolNumber();
        $rounded_teams_per_pool = floor($teams_per_pool);
        if($rounded_teams_per_pool !== $teams_per_pool)
            $teams_too_many = round(($teams_per_pool - $rounded_teams_per_pool)*$pools);  
        for($i=0; $i<$pools; $i++)
        {
            $pool = new Pool();
            $pool->number = $i+1 + $pool_count;
            $pool->tournament_id = $tournament->id;
            $pool->finished = 0;
            if($teams_too_many > 0)
            {
                $extra = 1;
                $teams_too_many -= 1;
            }
            else    $extra = 0;
            $teams_in_pool = [];    
            for($j=0; $j<$rounded_teams_per_pool+$extra; $j++) 
            {
                $teams_in_pool[] = $teams[$teams_iteration]; 
                $teams_iteration++;
            }
            $pool->save();
            $pool->teams()->sync($teams_in_pool); 
            $pool->save();
            $added_pools[] = $pool; 
        }
        return redirect(route('tournament', $tournament->id));
    }
    public function create(Request $request, $update=false)
    {
        $this->validator($request->all())->validate();  
        if(!Auth::Check())  
            return \Redirect::back()->withErrors(['Je moet ingelogd zijn.']); 
        $user = Auth::user();   
        $role = Role::Find($user->role_id); 
        if($update)
        {
            $tournament = Tournament::find($request->id);
            if(!$tournament)    return \Redirect::back()->withErrors(['Toernooi niet gevonden.']);  
        }
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
        else    return \Redirect::back()->withErrors(['Je hebt hier niet de juiste permissies voor.']);
    }
    public function edit(Request $request)
    {
        return $this->create($request, true);
    }
    public function remove(int $id)
    {
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een toernooi te verwijderen.']);
        $user = Auth::User();
        $tournament = Tournament::find($id);
        if(!$tournament)    return \Redirect::back()->withErrors(['Toernooi niet gevonden.']);
        if($user->role->permission >= 50)
        {
            $tournament->delete();
            return redirect(route('tournaments'));
        }
        else    return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om een toernooi te verwijderen.']);
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
    public function viewTournament($id, $user_id=null, $redirect=true)
    {
        if($user_id)
        {
            $user = User::find($user_id);
            if(!$user)  return \Redirect::back()->withErrors(['Gebruiker niet gevonden']);
        }
        else
        {
            if(!Auth::check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een toernooi te bekijken.']);
            $user = Auth::user();
        }
        $tournament = Tournament::find($id);
        if(!$tournament)    return \Redirect::back()->withErrors(['Toernooi niet gevonden.']);
        $user_permission = $user->role->permission;
        $team1=null;
        $team2=null;
        $my_first_match = $tournament->myFirstMatch($user->id);   
        if($my_first_match)
        {
            $team1 = $my_first_match->result1->team;  
            $team2 = $my_first_match->result2->team;  
        }
        $pools = $tournament->pools()->get()->all();    
        if($user_id)
            $my_pool = $tournament->myPools(null, $user_id)->first();
        else
            $my_pool = $tournament->myPools()->first();
        if(!$my_pool && !empty($pools))   $my_pool = $pools[0];
        if($pools && $my_pool)
            array_unshift($pools, $my_pool);    
        $current_date = new DateTime();  
        $current_date = $current_date->format('Y-m-d H:i:00');
        $current_matches = $tournament->matches()->where('has_ended', 0)->where('start', '<=', $current_date)->get();   
        $current_matches_2 = $tournament->extraMatches()->where('has_ended', 0)->where('start', '<=', $current_date)->get();    
        $current_matches = $current_matches->merge($current_matches_2)->all();  
        if(sizeof($current_matches) > 1)   
        {
            foreach ($current_matches as $key => $match)    
                $current_sort[$key] = strtotime($match['start']);   
            array_multisort($current_sort, SORT_DESC, $current_matches); 
            $current_matches = array_reverse($current_matches);  
        }
        $finished_matches = $tournament->matches()->where('has_ended', 1)->get();
        $finished_matches_2 = $tournament->extraMatches()->where('has_ended', 1)->get();
        $finished_matches = $finished_matches->merge($finished_matches_2)->all();
        if(sizeof($finished_matches) > 1)   
        {
            foreach ($finished_matches as $key => $match)    
                $finished_sort[$key] = strtotime($match['start']);   
            array_multisort($finished_sort, SORT_DESC, $finished_matches); 
            $finished_matches = array_reverse($finished_matches);  
        }
        $upcoming_matches = $tournament->matches()->where('has_ended', 0)->where('start', '>', $current_date)->get();
        $upcoming_matches_2 = $tournament->matches()->where('has_ended', 0)->where('start', null)->get();
        $upcoming_matches_3 = $tournament->extraMatches()->where('has_ended', 0)->where('start', '>', $current_date)->get();
        $upcoming_matches_4 = $tournament->extraMatches()->where('has_ended', 0)->where('start', null)->get();
        $upcoming_matches = $upcoming_matches->merge($upcoming_matches_2)->merge($upcoming_matches_3)->merge($upcoming_matches_4)->all();
        if(sizeof($upcoming_matches) > 1)   
        {
            foreach ($upcoming_matches as $key => $match)    
                $upcoming_sort[$key] = strtotime($match['start']);   
            array_multisort($upcoming_sort, SORT_DESC, $upcoming_matches); 
            $upcoming_matches = array_reverse($upcoming_matches);  
        }
        if($redirect)
        {
            return view('pages/tournament',
            [
                'id' => $id,
                'permission' => $user_permission,
                'match' => $my_first_match,
                'team1' => $team1,
                'team2' => $team2,
                'pools' => $pools,
                'current_matches' => $current_matches,
                'upcoming_matches' => $upcoming_matches,
                'finished_matches' => $finished_matches,
            ]);
        }
        else
        {
            $data = array(
                'id' => $id,
                'permission' => $user_permission,
                'match' => $my_first_match,
                'team1' => $team1,
                'team2' => $team2,
                'pools' => $pools,
                'current_matches' => $current_matches,
                'upcoming_matches' => $upcoming_matches,
                'finished_matches' => $finished_matches,
            );
            return $data;
        }
    }
    public function tournamentsList()
    {
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn een toernooien te bekijken']);
        $user = Auth::User();
        $current_date = date('Y-m-d');  
            $current = Tournament::whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date)->get(); 
            $upcoming = Tournament::whereDate('start_date', '>', $current_date)->get(); 
            $finished = Tournament::whereDate('start_date', '<', $current_date)->whereDate('end_date', '<', $current_date)->get();    
            $can_edit = true;
        if($user->role->permission < 50)
        {
            $can_edit = false;
        }
        return view('pages/tournaments',
        [
            'current_tournaments' => $current,
            'upcoming_tournaments' => $upcoming,
            'finished_tournaments' => $finished,
            'can_edit' => $can_edit
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
            else return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om een toernooi aan te maken.']);
        }
        else return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een toernooi te bekijken']);
    }
    public function showEditForm(int $id)
    {
        if(Auth::Check())
        {
            $user = Auth::User();
            $tournament = Tournament::find($id);
            if(!$tournament)    return \Redirect::back()->withErrors(['Toernooi niet gevonden.']);  
            if($user->role->permission >= 50)
            {
                return view('/pages/cud-tournament')
                    ->with('creating', false)
                    ->with('tournament', $tournament);
            }
            else    return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om een toernooi aan te passen.']); 
        }
        else    return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een toernooi te bekijken.']);   
        return redirect(route('home'));
    }
}
