<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tournament;
use App\Models\Team;
use App\Models\Role;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
class APITournamentController extends Controller
{
    public function index()
    {
        return Tournament::all();
     }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show(Tournament $tournament)
    {
        return $tournament;
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
    public function viewTournament($id)
    {
        $user = Auth::user();
        $tournament = Tournament::find($id);
        $team1=null;
        $team2=null;
        $my_first_match = $tournament->myFirstMatch($user->id);   
        if($my_first_match)
        {
            $team1 = $my_first_match->result1->team;  
            $team2 = $my_first_match->result2->team;  
        }
        $pools = $tournament->pools()->get()->all();    
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
                $sort[$key] = strtotime($match['start']);   
            array_multisort($sort, SORT_DESC, $current_matches); 
            $current_matches = array_reverse($current_matches);  
        }
        $finished_matches = $tournament->matches()->where('has_ended', 1)->get();
        $finished_matches_2 = $tournament->extraMatches()->where('has_ended', 1)->get();
        $finished_matches = $finished_matches->merge($finished_matches_2)->all();
        if(sizeof($finished_matches) > 1)   
        {
            foreach ($finished_matches as $key => $match)    
                $sort[$key] = strtotime($match['start']);   
            array_multisort($sort, SORT_DESC, $finished_matches); 
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
                $sort[$key] = strtotime($match['start']);   
            array_multisort($sort, SORT_DESC, $upcoming_matches); 
            $upcoming_matches = array_reverse($upcoming_matches);  
        }
        return Tournament::all();
    }
}
