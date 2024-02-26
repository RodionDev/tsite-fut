<?php
namespace App\Http\Controllers\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Match;
use App\Models\Role;
use App\Models\Result;
use App\Models\Team;
use App\Models\Tournament;
use App\Http\Controllers\Pages\TeamController;
use Validator;
class MatchController extends Controller
{
    public function editByRequest(Request $request)
    {
        return $this->edit($request, true);
    }
    public function remove($id)
    {
        $match = Match::find($id);
        if(!$match) return \Redirect::back()->withErrors(['Wedstrijd niet gevonden.']);
        $match->delete();
        return redirect( route('tournaments') );
    }
    public function create(Request $request)
    {
        return $this->edit($request, false);
    }
    public function edit(Request $request, $updating=true)
    {
        $this->validator($request->all())->validate();  
        if(!Auth::Check())  return \Redirect::back()->withErrors(['Je moet ingelod zijn om een wedstrijd aan te passen.']);
        $user = Auth::user();   
        $role = Role::Find($user->role_id); 
        if($role->permission < 50 && $role->permission !== 20)  return \Redirect::back()->withErrors(['Je hebt niet de juiste permissies om een wedstrijd aan te passen.']);
        if($updating)   
        {
            $match = Match::find($request->id);
            if(!$match) return \Redirect::back()->withErrors(['Wedstrijd niet gevonden.']);
            $result1 = Result::find($match->result1->id);
            $result2 = Result::find($match->result2->id);
        }
        else    
        {
            $team_controller = new TeamController;
            $match = new Match();
            $result1 = new Result();
            $result2 = new Result();
            $match->has_ended = 0;
            if($request->team1_id)
                $result1->team_id = $request->team1_id;
            else
            {
                $team = $team_controller->search($request->team1);
                $team_id = json_decode(json_encode($team))->original[0]->id;
                if($team) $result1->team_id = $team_id;
                else    return \Redirect::back()->withErrors(['Team 1 niet gevonden.']);
            }
            if($request->team2_id)
                $result2->team_id = $request->team2_id;
            else
            {
                $team = $team_controller->search($request->team2);
                $team_id = json_decode(json_encode($team))->original[0]->id;
                if($team) $result2->team_id = $team_id;
                else    return \Redirect::back()->withErrors(['Team 2 niet gevonden.']);
            }
            $result1->save();
            $result2->save();
            $match->result1_id = $result1->id;
            $match->result2_id = $result2->id;
            $match->save();
        }
        if($request->date)
        {
            $time = ($request->time) ? $request->time : '';
            $start = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));
            $match->start = $start;
        }
        if($request->field) $match->field = $request->field;
        if($request->tournament_id) $match->tournament_id = $request->tournament_id;
        if($request->score1 !== null && $request->score2 !== null)
        {
            $result1->score = $request->score1;
            $result2->score = $request->score2;
            $match->has_ended = 1;
        }
        $result1->save();
        $result2->save();
        $match->save();
        if(!$updating && $request->tournament_id)
            return redirect(route('match.create.route', $request->tournament_id));
        elseif($request->tournament_id)
            return redirect(route('tournament', $request->tournament_id));
        elseif($match->id)
            return redirect(route('match.edit.route', $match->id));
        else
            return redirect(route('tournaments'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data,
        [
            'field' => 'integer|nullable',
            'time' => 'date_format:H:i|nullable',
            'date' => 'required_with:time|date|nullable',
            'score1' => 'required_with:score2|integer|nullable',
            'score2' => 'required_with:score1|integer|nullable',
        ]);
    }
    public function showCreateForm($tournament_id)
    {
        if(!Auth::check())  return \Redirect::back()->withErrors(['Je moet ingelogd zijn om een wedstrijd aan te maken.']);
        $user = Auth::user();
        $permission = $user->role()->first()->permission;
        return view("/pages/ud-match", 
        [
            'updating' => false,
            'permission' => $permission,
            'tournament_id' => $tournament_id,
        ]);  
    }
    public function showEditForm($id)
    {
        $user = Auth::user();
        $permission = $user->role()->first()->permission;
        $match = Match::find($id);
        $start_time=null;
        $start_date=null;
        if($match->start)
        {
            $start_time = date_format(date_create($match->start), "H:i");
            $start_date = date_format(date_create($match->start), "Y-m-d");
        }
        return view("/pages/ud-match", 
        [
            'updating' => true,
            'match' => $match,
            'permission' => $permission,
            'start_time' => $start_time,
            'start_date' => $start_date
        ]);  
    }
    public function showScoreboard($id)
    {
        $tournament = Tournament::find($id);
        $matches = $tournament->matches()->where('has_ended', 1)->get();
        $matches2 = $tournament->extraMatches()->where('has_ended', 1)->get();
        $matches = $matches->merge($matches2);
        $results =[];
        $teams_has_not_played = Team::all()->all();
        $teams_has_played = [];
        foreach ($matches as $key => $match) 
        {
            $result1 = Result::find($match->result1_id);
            $result2 = Result::find($match->result2_id);
            if($result1->score == $result2->score)
            {
                $_results = [];
                array_push($_results, $result1, $result2);
                $match->tiedplayers = $_results;
                $matches[$key] = $match;
            }
            elseif($result1->score > $result2->score)
            {
                $match->winner = $result1;
                $match->loser = $result2;
                $matches[$key] = $match;
            }
            elseif($result1->score < $result2->score)
            {
                $match->winner = $result2;
                $match->loser = $result1;
                $matches[$key] = $match;
            }
        }
        foreach ($matches as $key => $match) 
        {
            if($match->winner && $match->loser)
            {
                $winner = $match->winner;
                $team = Team::find($winner->team_id);
                $team->points = $team->points + 3;
                if($team->lost == false)
                {
                    $team->lost = 0;
                }
                if($team->tied == false)
                {
                    $team->tied = 0;
                }
                $team->won = $team->won + 1;
                $team->goals =$team->goals + $match->winner->score;
                $team->countergoals = $team->countergoals + $match->loser->score;
                array_push($teams_has_played, $team);
                $loser = $match->loser;
                $team = Team::find($loser->team_id);
                if($team->points == false)
                {
                    $team->points = 0;
                }
                if($team->tied == false)
                {
                    $team->tied = 0;
                }
                if($team->won == false)
                {
                    $team->won = 0;
                }
                $team->lost = $team->lost + 1;
                $team->goals = $team->goals + $match->loser->score;
                $team->countergoals = $team->countergoals + $match->winner->score;
                array_push($teams_has_played, $team);
            }
            elseif ($match->tiedplayers)
            {
                foreach ($match->tiedplayers as $key => $tiedplayer)
                {
                    $team = Team::find($tiedplayer->team_id);
                    if($team->won == false)
                    {
                        $team->won = 0;
                    }
                    if($team->lost == false)
                    {
                        $team->lost = 0;
                    }
                    $team->points = $team->points + 1;
                    $team->tied = $team->tied + 1;
                    $team->goals =$team->goals + $tiedplayer->score;
                    $team->countergoals = $team->countergoals + $tiedplayer->score;
                    array_push($teams_has_played, $team);
                }
            }
        }
        $teams = $this->checkArrayDuplicateTeam($teams_has_played);
        $teams = $this->mergeTeams($teams, $teams_has_not_played);
        $teams_sort;
        foreach ($teams as $key => $team) 
        {
            $teams_sort[$key] = $team->points;
        }
        array_multisort($teams_sort, SORT_DESC, $teams);
        return view('pages.scoreboard', compact('teams'));
    }
    private function mergeTeams($merge_array, $source_array)
    {
        foreach ($source_array as $key => $team) 
        {
            $team->points = 0;
            $team->won = 0;
            $team->lost = 0;
            $team->tied = 0;
            $team->goals = 0;
            $team->countergoals = 0;
            array_push($merge_array, $team);
            $merge_array = $this->checkArrayDuplicateTeam($merge_array);
        }
        return $merge_array;
    }
    private function checkArrayDuplicateTeam($teams_array)
    {
        $newArray = [];
        foreach ($teams_array as $key => $team) 
        {
            if(array_key_exists($team->id, $newArray))
            {
                foreach ($newArray as $key => $_team) 
                {
                    if($_team->id == $team->id)
                    {
                        $team->won = $team->won + $_team->won;
                        $team->lost = $team->lost + $_team->lost;
                        $team->tied = $team->tied + $_team->tied;
                        $team->goals = $team->goals + $_team->goals;
                        $team->countergoals = $team->countergoals + $_team->countergoals;
                        $team->points = $team->won * 3 + $team->tied * 1;
                        $newArray[$key] = $team;
                    }
                }
            }
            else 
            {
                $newArray[$team->id] = $team;
            }
        }
        $newArray = $this->sortByPoints($newArray, 'points');
        return $newArray;
    }
    function sortByPoints($array, $property)
    {
        foreach ($array as $key => $array_item) 
        {
        }
        return $array;
    } 
}
