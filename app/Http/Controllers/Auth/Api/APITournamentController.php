<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Pages\TournamentController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tournament;
use App\Models\Team;
use App\Models\Result;
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
    public function viewTournament($tournament_id)
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token)->toArray();
        $tournament_controller = new TournamentController;
        $data =[ $tournament_controller->viewTournament($tournament_id, $payload['sub'], false)]; 
        $upcoming_matches = [ $tournament_controller->viewTournament($tournament_id, $payload['sub'], false)][0]['upcoming_matches']; 
            $teams = array();
                foreach( $upcoming_matches as $key => $match ){
                $start = $match['start'];
                $field = $match['field'];
                $team1 = Team::find(Result::find($match['result1_id'])->team_id);
                $team2 = Team::find(Result::find($match['result2_id'])->team_id);
                $upcoming_matches[$key]["team1"] = $team1;
                $upcoming_matches[$key]["team2"] = $team2;
                }
                return $upcoming_matches;
    }
    public function viewFirstmatch($tournament_id)
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token)->toArray();
        $tournament_controller = new TournamentController;
        $data =[ $tournament_controller->viewTournament($tournament_id, $payload['sub'], false)]; 
                return $data;
    }
}
